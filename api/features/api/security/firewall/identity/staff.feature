@api @security @firewall @identity @staff
Feature: Deny access to non-authenticated users to staff identity endpoints

  Scenario: Browse staff identities
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/staffs"
    Then the response status code should be 401
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON

  Scenario: Read a staff identity
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/staffs/06f8bb0b-45e3-46af-94c7-ff917f720c82"
    Then the response status code should be 401
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON

  Scenario: Add a staff identity
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "POST" request to "/staffs" with body:
    """
    {}
    """
    Then the response status code should be 401
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON

  Scenario: Edit a staff identity
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "PUT" request to "/staffs/06f8bb0b-45e3-46af-94c7-ff917f720c82" with body:
    """
    {}
    """
    Then the response status code should be 401
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON

  Scenario: Delete a staff identity
    When I add "Accept" header equal to "application/json"
    And I send a "DELETE" request to "/staffs/06f8bb0b-45e3-46af-94c7-ff917f720c82"
    Then the response status code should be 401
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON