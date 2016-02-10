  This is the Sudoku class which reads a 9x9 sudoku board from a txt file and checks if it is a valid or not.
  Following are the conditions we need to check for a valid sudoku:

   Duplicate numbers on each row are 0
   Duplicate numbers on each column are 0
   Duplicate numbers on each 3x3 region are 0

  This class reads sudoku board from a file in string format, then converts it to a 2D array of size 9x9.
  When converting from array it validates each row for duplicates.
  Then it checks each columns for duplicate numbers and after that it checks each 3x3 reagions.
  If sudoku is valid it retuns 1 else it returns 0