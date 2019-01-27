@api @security @tenant @identity @individual
Feature: Deny access to individual identities belonging to other tenants

  Background:
    Given I am authenticated as the "system@system.ds" user from the tenant "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"

  Scenario: Browse individual identities from your own tenant
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/individuals"
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

  Scenario: Read an individual identity from an other tenant
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/individuals/e28fabd0-aae5-4f21-bedd-e4d32658484b"
    Then the response status code should be 404
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON

  Scenario: Edit an individual identity from an other tenant
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "PUT" request to "/individuals/e28fabd0-aae5-4f21-bedd-e4d32658484b" with body:
    """
    {}
    """
    Then the response status code should be 404
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON

  Scenario: Delete an individual identity from another tenant
    When I add "Accept" header equal to "application/json"
    And I send a "DELETE" request to "/individuals/e28fabd0-aae5-4f21-bedd-e4d32658484b"
    Then the response status code should be 404
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON
