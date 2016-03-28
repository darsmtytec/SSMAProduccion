<?php
/**
 * Created by PhpStorm.
 * User: L03020776
 * Date: 16/03/2016
 * Time: 11:58 AM
 */
/**
 * Generating CSV formatted string from an array.
 */
$array  = $_POST['arrayExport'];
var_dump($array);
function convert_to_csv($input_array, $output_file_name, $delimiter)
{
    $temp_memory = fopen('php://memory', 'w');
// loop through the array
    foreach ($input_array as $line) {
// use the default csv handler
        fputcsv($temp_memory, $line, $delimiter);
    }

    fseek($temp_memory, 0);
// modify the header to be CSV format
    header('Content-Type: application/csv');
    header('Content-Disposition: attachement; filename="' . $output_file_name . '";');
// output the file to be downloaded
    fpassthru($temp_memory);
}

$array_of_data = Array(
    Array(1,
        'Dave',
        'Smith',
        'dave[at]dave.com'
    ),
    Array(2,
        'Sam',
        'Adams',
        'sam[@]adams.com'
    ),
    Array(3,
        'Gary',
        'Davis',
        'gary[at]davis.com'
    )
);

convert_to_csv($array, 'data_as_csv.csv', ',');
/*$header_row = false;
$col_sep = ",";
$row_sep = "\n";
$qut = '"';
if (!is_array($array) or !is_array($array[0])) return false;

//Header row.
if ($header_row)
{
    foreach ($array[0] as $key => $val)
    {
        //Escaping quotes.
        $key = str_replace($qut, "$qut$qut", $key);
        $output .= "$col_sep$qut$key$qut";
    }
    $output = substr($output, 1)."\n";
}
//Data rows.
foreach ($array as $key => $val)
{
    $tmp = '';
    foreach ($val as $cell_key => $cell_val)
    {
        //Escaping quotes.
        $cell_val = str_replace($qut, "$qut$qut", $cell_val);
        $tmp .= "$col_sep$qut$cell_val$qut";
    }
    $output .= substr($tmp, 1).$row_sep;
}

echo json_encode($output);*/