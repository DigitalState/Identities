@api @security @tenant @identity @staff
Feature: Deny access to staff identities belonging to other tenants

  Background:
    Given I am authenticated as the "system@system.ds" user from the tenant "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"

  Scenario: Browse staff identities from your own tenant
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/staffs"
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

  Scenario: Read a staff identity from an other tenant
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/staffs/0c3beffd-988a-468c-b873-68b1dbac71e4"
    Then the response status code should be 404
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON

  Scenario: Edit a staff identity from an other tenant
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "PUT" request to "/staffs/0c3beffd-988a-468c-b873-68b1dbac71e4" with body:
    """
    {}
    """
    Then the response status code should be 404
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON

  Scenario: Delete a staff identity from another tenant
    When I add "Accept" header equal to "application/json"
    And I send a "DELETE" request to "/staffs/0c3beffd-988a-468c-b873-68b1dbac71e4"
    Then the response status code should be 404
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON
