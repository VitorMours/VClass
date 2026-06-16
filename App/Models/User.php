<?php


/**
 * @author Joao Vitor Rezende Moura
 * Class to be NOT implemented, only an abstract class to determine the behaviour 
 * of the students and the teatchers inside the class. 
 */
class User {


  /**
   * @author Joao Vitor Rezende Moura
   * class constructor to create the user entity
   * @param firstName : The parameter to determine the user first name
   * @param lastName : The parameter to determine the user last name
   * @param password : The parameter to determine the user password
   * 
   * @return User
   */
  public function __construct(private string $firstName, private ?string $lastName, private string $password){}

  public function getFirstName() {}



  }
