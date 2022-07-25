Test tasks:

all answers should be written to the tasks.php file.
The file should contain class Answers with 10 methods
each task should be written in the format:
```
class Answers {

function task_{task#} (arguments) {
    return result (in specified type)
}

}
```
at the end of the file, we should have a default export section where we do the export of all tasks functions



1) need to do a transformation of the array with diff numbers [1  ... n]  - we need to reverse it without using the reverse method and return in format [n  ... 1]
   Arguments: array
   Result: array

2) need to make a deep check of two arrays with the random count of items - that they have the same items. The order of items and arrays length can be different. We could get all JS types here except Symbol.  We need to get a boolean type as a result
   Arguments: array1, array2
   Result: boolean

3) need to check the array with structure [ [id: (int), value: (any) ] ]. we should group it by id property and count the same value property types. equal objects should be counted only 1 time. as response we should return array with the structure [ [id: 1, number: 1, string: 10 ] ]
   Arguments: [ [id: (number), value: (any) ] ]
   Result: array


Example:  
Input
[id: 1, value: 2],
[id: 1, value: 'asd'],
[id: 1, value: 'asd’]
Output
[[id: 1, number: 1, string: 1]]


4) need to count the difference (even - odd) in the sum of all values even and odd indexes from the array with integers. As a response, we should return an integer value.
   Arguments: [ 1, 44, 2234, 0, 4, -1 ] positive and negative numbers
   Result: integer

5) we should return all indexes from the string with random lengths where the needed character exists. as the response, we should return an array with integer values
   Arguments: 'asdasdasdasd' 'a' (two strings)
   Result: array with integer

6) we should return the max count of characters repeating from the string with random length with case insensitive search. as the response, we should return the integer value
   Arguments: 'asdasdasdasd' 'a' (two random strings)
   Result: integer

7) need to do a transformation of array with structure [ [currency: (string), value: (any)] ], need to do sum of all valid values grouped by currency property and return an array in format [ 'USD:12.00', 'EUR:1.02', UAH:3.00']
   Arguments: [ [currency: (string), value: (any) ], ….. ,[currency: (string), value: (any) ] ]
   Result: array with strings [ 'USD:12.00', 'EUR:1.02', UAH:3.00']

8) need to do a transformation of the array with random elements and types. need to take only alphanumeric characters and spaces and do concatenation of elements. as the response, we should return the string value
   Arguments: [ 1, ‘asd’, ‘ff’,  ' ', null, false]
   Result: string

9) need to do a transformation of the array with structure [[id: (int), done: (bool) ]...,[id: (int), done: (bool)] ]. We need to check that all objects marked as done (done == true). we need to get a boolean type as a result
   Arguments: [ [id: (int), done: (bool) ], …, [id: (int), done: (bool) ] ]
   Result: boolean

10)  need to replace each plaintext letter with a different one in a fixed number of places (can be negative too) down the English alphabet. For example 'D' will be transformed into 'A', 'E' will be transformed into 'B', and so on if the key will be queal 3. As a result, we should get a string value.
     Arguments: 'Lorem ipsum dolor sit amet.', 3
     Result: string
