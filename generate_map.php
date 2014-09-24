<?php

    function unemployment2009() {
        $csvfile = 'datasets/unemployment09.csv';
        $svgfile = "img/counties.svg";

        $svg = simplexml_load_file("img/counties.svg");
        $svg->registerXPathNamespace('svg', 'http://www.w3.org/2000/svg');

        $path_style = 'stroke:#FFFFFF;stroke-opacity:1;
        stroke-width:0.1;stroke-miterlimit:4;stroke-dasharray:none;stroke-linecap:butt;
        marker-start:none;stroke-linejoin:bevel;fill:';

        # light to dark
        $colors = array("#F1EEF6", "#D4B9DA", "#C994C7", "#DF65B0", "#DD1C77", "#980043", "#5F002A");

        if (($handle = fopen($csvfile, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $fips = $data[1] . $data[2];
                $ur = end($data);

                switch ($ur) {
                    case $ur > 20:
                        $color = 6;
                        break;
                    case $ur > 15:
                        $color = 5;
                        break;
                    case $ur > 10:
                        $color = 4;
                        break;
                    case $ur > 8:
                        $color = 3;
                        break;
                    case $ur > 6:
                        $color = 2;
                        break;
                    case $ur > 2:
                        $color = 1;
                        break;
                    default:
                        $color = 0;
                }

                $path = $svg->xpath('//svg:path[@id=' . $fips .']')[0];
                $path->attributes()['style'] = $path_style . $colors[$color];
            }
        }

        return $svg->asXML();
    }

    function presidentialElection() {
        $csvfile = 'datasets/US_elect_county_new.csv';
        $svgfile = "img/counties.svg";


        $svg = simplexml_load_file("img/counties.svg");
        $svg->registerXPathNamespace('svg', 'http://www.w3.org/2000/svg');

        $path_style = 'stroke:#FFFFFF;stroke-opacity:1;
        stroke-width:0.1;stroke-miterlimit:4;stroke-dasharray:none;stroke-linecap:butt;
        marker-start:none;stroke-linejoin:bevel;fill:';

        if (($handle = fopen($csvfile, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $fips = $data[2];
                if ($fips) {
                    $obama_vote  = $data[4];
                    $romney_vote = $data[6];

                    $color = $obama_vote > $romney_vote ? 'blue' : 'red';
                    #echo "***" . $fips . "***", "\n";
                    $path = $svg->xpath('//svg:path[@id=' . $fips .']')[0];
                    if ($path) {
                        $path->attributes()['style'] = $path_style . $color;
                    }
                }
            }

            return $svg->asXML();
        }
    }

    echo presidentialElection();
