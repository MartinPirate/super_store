<?php

namespace Tests\Feature;

use App\Http\Controllers\Api\SupermarketController;
use App\Http\Requests\CreateSupermarketRequest;
use App\Http\Requests\UpdateSupermarketRequest;
use App\Models\Location;
use App\Models\Supermarket;
use App\Repository\SupermarketRepository;
use App\Services\SupermarketService;
use App\Services\SupplierService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\JsonResponse;
use Mockery;
use Tests\TestCase;

class SupermarketTest extends TestCase
{

    use RefreshDatabase;


    private $supermarketService;
    private $supplierService;
    private $supermarketController;

    public function setUp(): void
    {
        parent::setUp();
        $this->supermarketService = Mockery::mock(SupermarketService::class);
        $this->supplierService = Mockery::mock(SupplierService::class);
        $this->supermarketController = new SupermarketController($this->supermarketService, $this->supplierService);
    }

    public function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function testIndexReturnsJsonResponse()
    {
        $serviceMock = Mockery::mock(SupermarketService::class);

        $data = [
            'supermarkets' => [
                ['name' => 'Supermarket A', 'location' => 'New York'],
                ['name' => 'Supermarket B', 'location' => 'Los Angeles'],
            ]
        ];

        $serviceMock->shouldReceive('getSupermarkets')->andReturn(response()->json($data));

        $controller = new SupermarketController($serviceMock, $this->supplierService);


        $response = $controller->index();

        $this->assertInstanceOf(JsonResponse::class, $response);
    }

    /**
     * Test show method
     *
     * @return void
     */
    public function testShow()
    {
        $supermarketRepositoryMock = $this->getMockBuilder(SupermarketRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $supermarketServiceMock = $this->getMockBuilder(SupermarketService::class)
            ->setConstructorArgs([$supermarketRepositoryMock])
            ->getMock();


        $supermarket = Supermarket::factory()->create([
            'name' => 'Test SuperStore',
            'location_id' => 1
        ]);

        $this->assertDatabaseCount("supermarkets", 1);

        $supermarketServiceMock->expects($this->once())
            ->method('getSupermarketById')
            ->with($this->equalTo(1))
            ->willReturn(response()->json($supermarket));

        $controller = new SupermarketController($supermarketServiceMock, $this->supplierService);

        $response = $controller->show(1);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertJsonStringEqualsJsonString(
            json_encode($supermarket->toArray(), JSON_PRETTY_PRINT),
            $response->getContent()
        );
    }


    /**
     * Test store method
     * @return void
     */
    public function testStore()
    {
        $supermarketRepositoryMock = $this->getMockBuilder(SupermarketRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $supermarketServiceMock = $this->getMockBuilder(SupermarketService::class)
            ->setConstructorArgs([$supermarketRepositoryMock])
            ->getMock();


        $location = Location::factory()->create([
            'name' => 'Location',
        ]);
        $this->assertDatabaseCount("locations", 1);

        $supermarket = [
            'name' => 'Test Supermarket',
            'location_id' => $location->id,
        ];

        $supermarketServiceMock->expects($this->once())
            ->method('createSupermarket')
            ->with($this->equalTo($supermarket))
            ->willReturn(response()->json($supermarket));


        $this->post('/api/v1/supermarkets', [
            'name' => 'Test Supermarket',
            'location_id' => $location->id,
        ]);

        $controller = new SupermarketController($supermarketServiceMock, $this->supplierService);

        $response = $controller->store(new CreateSupermarketRequest($supermarket));

        $this->assertInstanceOf(JsonResponse::class, $response);


        $this->assertDatabaseCount("supermarkets", 1);

    }

    /**
     * test update request
     * @return void
     */
    public function testUpdate()
    {
        $supermarketRepositoryMock = $this->getMockBuilder(SupermarketRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $supermarketServiceMock = $this->getMockBuilder(SupermarketService::class)
            ->setConstructorArgs([$supermarketRepositoryMock])
            ->getMock();

        $supermarket = Supermarket::factory()->create([
            'name' => 'Test SuperStore',
            'location_id' => 1
        ]);

        $this->assertDatabaseCount("supermarkets", 1);

        $updatedData = [
            'name' => 'Updated Supermarket',
            'location_id' => 1
        ];

        $supermarketServiceMock->expects($this->once())
            ->method('updateSupermarket')
            ->with($this->equalTo($supermarket->id), $this->equalTo($updatedData))
            ->willReturn(response()->json($updatedData));

        $controller = new SupermarketController($supermarketServiceMock, $this->supplierService);

        $request = new UpdateSupermarketRequest($updatedData);

        $response = $controller->update($request, $supermarket->id);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertJsonStringEqualsJsonString(
            json_encode($updatedData, JSON_PRETTY_PRINT),
            $response->getContent()
        );
    }

    /**
     * test delete
     * @return void
     */
    public function testDestroy()
    {
        $supermarketRepositoryMock = $this->getMockBuilder(SupermarketRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $supermarketServiceMock = $this->getMockBuilder(SupermarketService::class)
            ->setConstructorArgs([$supermarketRepositoryMock])
            ->getMock();

        $supermarket = Supermarket::factory()->create([
            'name' => 'Test SuperStore',
            'location_id' => 1
        ]);

        $this->assertDatabaseCount("supermarkets", 1);
        $supermarketServiceMock->expects($this->once())
            ->method('deleteSupermarket')
            ->with($this->equalTo($supermarket->id))
            ->willReturn(response()->json(null, 204));

        $controller = new SupermarketController($supermarketServiceMock, $this->supplierService);

        $response = $controller->destroy($supermarket->id);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(204, $response->getStatusCode());
    }

}
