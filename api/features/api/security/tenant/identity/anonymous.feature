@api @security @tenant @identity @anonymous
Feature: Deny access to anonymous identities belonging to other tenants

  Background:
    Given I am authenticated as the "system@system.ds" user from the tenant "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"

  Scenario: Browse anonymous identities from your own tenant
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/anonymouses"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "items": {
        "type": "object",
        "properties": {
          "tenant": {
            "type": "string",
            "pattern": "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"
          }
        }
      },
      "required": [
        "tenant"
      ]
    }
    """

  Scenario: Read an anonymous identity from an other tenant
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/anonymouses/7fd2e84f-b8d6-435d-9339-127e244e8fd0"
    Then the response status code should be 404
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON

  Scenario: Edit an anonymous identity from an other tenant
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "PUT" request to "/anonymouses/7fd2e84f-b8d6-435d-9339-127e244e8fd0" with body:
    """
    {}
    """
    Then the response status code should be 404
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON

  Scenario: Delete an anonymous identity from another tenant
    When I add "Accept" header equal to "application/json"
    And I send a "DELETE" request to "/anonymouses/7fd2e84f-b8d6-435d-9339-127e244e8fd0"
    Then the response status code should be 404
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON
