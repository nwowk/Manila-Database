<?php
/*
 This file will generate our CSV table. There is nothing to display on this page, it is simply used
 to generate our CSV file and then exit. That way we won't be re-directed after pressing the export
 to CSV button on the previous page.
*/

//First we'll generate an output variable called out. It'll have all of our text for the CSV file.
$out ="District, Households, Population, AVG_Household_Size, Light_Materials, Semi_Concrete, Concrete, AVG_Stories, No_Foundation, Slab, Bamboo, Wood, Steel_Platform, Cinder_blocks, Other_foundation, Concrete_Roof, Light_materials, Metal_roof, Mixed_roof, Under_6, Over_60, Dependents, Income_1, Income_2, Income_3, Income_4, Income_5, Income_NA, Evac_plan, Training, Garbage_Collector, Burning, Dumping_public, Dumping_water, Well, Faucet, River, Pipe, Seller, Other_water, SMS, email, radio, TV, Female_HoH, AVG_HoH Age"."\n";
//Next we'll check to see if our variables posted and if they did we'll simply append them to out.

if (isset($_POST['csv_output'])) {
$out .= $_POST['csv_output'];
}

//Now we're ready to create a file. This method generates a filename based on the current date & time.
$filename = "result_".date("Y-m-d_H-i",time());

//Generate the CSV file header
header("Content-type: text/csv");
header("Content-disposition: csv" . date("Y-m-d") . ".csv");
header("Content-disposition: filename=".$filename.".csv");

//Print the contents of out to the generated file.
print $out;

//Exit the script
exit;
?>
