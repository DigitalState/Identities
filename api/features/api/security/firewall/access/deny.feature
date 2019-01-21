@api @security @firewall @access @deny
Feature: Deny access to non-authenticated users to access endpoints

  Scenario: Browse accesses
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/accesses"
    Then the response status code should be 401
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON

  Scenario: Read an access
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/accesses/db3fd78d-821a-41ae-bab2-501ede3c6693"
    Then the response status code should be 401
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON

  Scenario: Add an access
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "POST" request to "/accesses" with body:
    """
    {}
    """
    Then the response status code should be 401
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON

  Scenario: Edit an access
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "PUT" request to "/accesses/db3fd78d-821a-41ae-bab2-501ede3c6693" with body:
    """
    {}
    """
    Then the response status code should be 401
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON

  Scenario: Delete an access
    When I add "Accept" header equal to "application/json"
    And I send a "DELETE" request to "/accesses/db3fd78d-821a-41ae-bab2-501ede3c6693"
    Then the response status code should be 401
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON