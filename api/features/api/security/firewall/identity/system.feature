@api @security @firewall @identity @system
Feature: Deny access to non-authenticated users to system identity endpoints

  Scenario: Browse system identities
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/systems"
    Then the response status code should be 401
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON

  Scenario: Read a system identity
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/systems/aa18b644-a503-49fa-8f53-10f4c1f8e3a1"
    Then the response status code should be 401
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON

  Scenario: Add a system identity
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "POST" request to "/systems" with body:
    """
    {}
    """
    Then the response status code should be 401
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON

  Scenario: Edit a system identity
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "PUT" request to "/systems/aa18b644-a503-49fa-8f53-10f4c1f8e3a1" with body:
    """
    {}
    """
    Then the response status code should be 401
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON

  Scenario: Delete a system identity
    When I add "Accept" header equal to "application/json"
    And I send a "DELETE" request to "/systems/aa18b644-a503-49fa-8f53-10f4c1f8e3a1"
    Then the response status code should be 401
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON