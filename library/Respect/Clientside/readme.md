** Client-side validation using Respect validator

This directory will contain :

* An abstraction layer between Respect/Validation and any other class/function that wants to use it
* A PHP file that client-side will query. This PHP file talks to the abstraction and returns T/F values and errors if something is not valid
* A jQuery module that deals with this information
* A jQuery module that deals with this information and is written specifically for bootstrap 3 forms