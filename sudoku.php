<?php
/*
*  This is the Sudoku class which reads a 9x9 sudoku board from a txt file and checks if it is a valid or not.
*  Following are the conditions we need to check for a valid sudoku:
*   Duplicate numbers on each row
*   Duplicate numbers on each column
*   Duplicate numbers on each 3x3 region
*  This class reads sudoku board from a file in string format, then converts it to a 2D array of size 9x9.
*  When converting from array it validates each row for duplicates.
*  Then it checks each columns for duplicate numbers and after that it checks each 3x3 reagions.
*  If sudoku is valid it retuns 1 else it returns 0
*
* @author Sushant Gawali <sushant.gawali@gmail.com>
* @package Sudoku
* @version 1.0.
* @license GPL2
*/


class Sudoku {

    // To store file input
    private $sudoku_string;

    // To store sudoku in array form after converting from file input
    private $sudoku_array;

    // Constructor to take input from file
   function __construct($sudoku_string)
   {
       $this->sudoku_string = preg_replace("/[\r\n]+/", " ", $sudoku_string);
   }

   /**
    * convert_and_validate_rows
    *
    * Converts file input from string format to 2D array
    * and checks if rows in array are valid
    *
    * @access private
    * @param none
    * @return bool
   */
   private function convert_and_validate_rows(){

       // convert string to an array
       $this->sudoku_array = explode(' ', $this->sudoku_string);

       if(count($this->sudoku_array) != 9){
            return false;
       }

       // convert each string array to digits array
       foreach($this->sudoku_array as &$row){
           $row = str_split($row);

           // check if the row if valid
           if(count($row) != 9 || count(array_unique($row)) !=9){
               return false;
           }
       }

       return true;
   }

    /**
     * validate_columns
     *
     * Validates all columns in given sudoku board
     *
     * @access private
     * @param none
     * @return bool
     */
    private function validate_columns(){

        for($i=0;$i<9;$i++){
            $col = array_column($this->sudoku_array, $i);

            if(count($col) !=9 || count(array_unique($col)) !=9){
                return false;
            }
        }
        return true;
    }

    /**
     * validate_regions
     *
     * Validates all 3x3 regions in given sudoku board
     *
     * @access private
     * @param none
     * @return bool
     */
    private function validate_regions(){

        for ($row = 0; $row < 9; $row += 3) {
            for ($col = 0; $col < 9; $col += 3) {

                // validate each 3x3 region
                if (!$this->validate_region($row, $col)) {
                    return false;
                }
            }
        }
        return true;
    }

    /**
     * validate_region
     *
     * Validates a 3x3 region
     *
     * @access private
     * @param $startRow, $startCol
     * @return bool
     */
    private function validate_region($startRow, $startCol){

        $temp = array();

        for ($row = $startRow; $row < $startRow+3; $row++) {
            for ($col = $startCol; $col < $startCol+3; $col++) {
                $temp[] = $this->sudoku_array[$row][$col];
            }
        }

        // check if all digits in a 3x3 regions are unique
        if(count(array_unique($temp)) !=9){
            return false;
        }

        return true;
    }

    /**
     * validate
     *
     * Checks all conditions for a valid sudoku
     *
     * @access private
     * @param none
     * @return 1 or 0
     */
    public function validate(){

        if(!$this->convert_and_validate_rows()){
            return 0;
        }

        if(!$this->validate_columns()){
            return 0;
        }

        if(!$this->validate_regions()){
            return 0;
        }

        return 1;
    }
}

// Read file contents
$puzzle = file_get_contents('puzzle.txt');

// Create sudoku
$su = new Sudoku($puzzle);

// Check if its valid or not
print $su->validate();
