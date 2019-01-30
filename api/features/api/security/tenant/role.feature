@api @security @tenant @role
Feature: Deny access to roles belonging to other tenants

  Background:
    Given I am authenticated as the "system@system.ds" user from the tenant "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"

  Scenario: Browse roles from your own tenant
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/business_units"
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

  Scenario: Read a role from an other tenant
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/roles/72ecd949-6960-4d9d-8baa-3dc15c2cbd63"
    Then the response status code should be 404
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON

  Scenario: Edit a role from an other tenant
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "PUT" request to "/roles/72ecd949-6960-4d9d-8baa-3dc15c2cbd63" with body:
    """
    {}
    """
    Then the response status code should be 404
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON

  Scenario: Delete a role from another tenant
    When I add "Accept" header equal to "application/json"
    And I send a "DELETE" request to "/roles/72ecd949-6960-4d9d-8baa-3dc15c2cbd63"
    Then the response status code should be 404
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON
