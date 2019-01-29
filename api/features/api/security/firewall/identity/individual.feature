@api @security @firewall @identity @individual
Feature: Deny access to non-authenticated users to individual identity endpoints

  Scenario: Browse individual identities
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/individuals"
    Then the response status code should be 401
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON

  Scenario: Read an individual identity
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/individuals/9ce3bdb9-47e1-43c9-81ee-0dcc2106ba42"
    Then the response status code should be 401
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON

  Scenario: Add an individual identity
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "POST" request to "/individuals" with body:
    """
    {}
    """
    Then the response status code should be 401
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON

  Scenario: Edit an individual identity
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "PUT" request to "/individuals/9ce3bdb9-47e1-43c9-81ee-0dcc2106ba42" with body:
    """
    {}
    """
    Then the response status code should be 401
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON

  Scenario: Delete an individual identity
    When I add "Accept" header equal to "application/json"
    And I send a "DELETE" request to "/individuals/9ce3bdb9-47e1-43c9-81ee-0dcc2106ba42"
    Then the response status code should be 401
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON