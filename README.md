# Update Status

- [04/04/24] 
    - Add functionalities for **employee**, including Add, Insert.
    - Enable employees to change **SSN** if want.
    - Each **employee** can't edit edmployee type if it is not **None**. If want to change the employee type, must delete the orginal one and Add again.
    - Each **Edit & Delete** for employee type buttons are directed straight to the **Employee** button of each type, so don't have to worry about FKs.
    - Did not add multiple values of shift for **traffic controller**.

- [05/04/24]
    - Changing the sidebar of employee
    - Fix Flight Employee & Pilot & Flight Attendant --> edit and add
    - Enable employees to change roles, enable multiple choice on traffic controller
    - Assign new DDL in the App.
    - Airline, Employee still ok
    - Add Edit of Owner not done
    - List of Consultant ok
    - Fail to delete of Model, Airplane --> Delete Airplane is fine, something wrong with the returned value.
    - Flight only List and Delete ok --> fixed delete (previous version accidently delete in airplane), add is fix
    - Fix Airport after new DDL
    - Fix 'Electrical Engineer' to 'Electric Engineer', fix edit and add in Flight Employee.
    - Fixed deletion in Model and Airplane, bug in typo in ajax.php
- [06/04/24]
    - Add Add and Edit for Flight
    - Flight can now choose actual arrival and departure time, Unassigned flights don't have AAT and ADT, On Air flights don't have AAT, Landed flights have all four.
    - AAT, ADT, EAT, EDT are able to select date and time.
- [07/04/24]
    - Update view of Airport, Airline, Owner, Model
    - Model still not add or edit
    - Just View, Not check update delete on that view