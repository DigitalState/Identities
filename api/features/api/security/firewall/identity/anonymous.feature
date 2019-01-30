@api @security @firewall @identity @anonymous
Feature: Deny access to non-authenticated users to anonymous identity endpoints

  Scenario: Browse anonymous identities
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/anonymouses"
    Then the response status code should be 401
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON

  Scenario: Read an anonymous identity
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/anonymouses/ad1a4ee4-b707-4135-b8e9-498286d5830c"
    Then the response status code should be 401
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON

  Scenario: Add an anonymous identity
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "POST" request to "/anonymouses" with body:
    """
    {}
    """
    Then the response status code should be 401
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON

  Scenario: Edit an anonymous identity
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "PUT" request to "/anonymouses/ad1a4ee4-b707-4135-b8e9-498286d5830c" with body:
    """
    {}
    """
    Then the response status code should be 401
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON

  Scenario: Delete an anonymous identity
    When I add "Accept" header equal to "application/json"
    And I send a "DELETE" request to "/anonymouses/ad1a4ee4-b707-4135-b8e9-498286d5830c"
    Then the response status code should be 401
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON