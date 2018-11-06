<?php
/**
 * Created by PhpStorm.
 * User: tiganaochieng
 * Date: 11/10/2018
 * Time: 09:13
 */


namespace App\Traits;

use Charts;


trait BuildCharts
{

    /**
     * Create a chart
     *
     * @param $chart_type
     * @param $chart_title
     * @param $element_label
     * @param $labels
     * @param $values
     * @param string $template
     * @return mixed
     */
    public function buildChart($chart_type, $chart_title, $element_label, $labels, $values, $template = 'material')
    {
        $chart = Charts::create($chart_type, 'Chartjs')
            ->title($chart_title)
            ->dimensions(0, 400)
            ->elementLabel($element_label)
            ->template($template)
            ->labels($labels)
            ->values($values)
            ->loader(false);

        return $chart;
    }

    /**
     * Build a database chart
     *
     * @param $DB_data
     * @param $chart_type
     * @param $chart_title
     * @param $element_label
     * @param $labels
     * @param $values
     * @param string $template
     * @return mixed
     */
    public function buildDatabaseChart($DB_data, $chart_type, $chart_title, $element_label, $labels, $values, $template = 'material')
    {
        $chart = Charts::database($DB_data, $chart_type, 'chartjs')
            ->title($chart_title)
            ->dimensions(0, 400)
            ->elementLabel($element_label)
            ->template($template)
            ->labels($labels)
            ->values($values)
            ->loader(false);

        return $chart;
    }
}
