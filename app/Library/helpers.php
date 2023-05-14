<?php


use Illuminate\Support\Carbon;

if (!function_exists('format_date')) {
    /**
     * Format date
     * @param string $date
     * @return string
     */
    function format_date(string $date): string
    {
        $date = Carbon::parse($date);
        if (!$date) {
            return 'No date Found';
        }
        return $date->format('j-F-  H:i:s');
    }
}

if (!function_exists('getCount'))
{
    /**
     * Get Json Data Count
     * @param $data
     * @return int
     */
    function getCount($data): int
    {
        $data = json_decode($data, true);
        return count($data);
    }
}