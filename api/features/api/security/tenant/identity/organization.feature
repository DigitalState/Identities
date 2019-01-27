@api @security @tenant @identity @organization
Feature: Deny access to organization identities belonging to other tenants

  Background:
    Given I am authenticated as the "system@system.ds" user from the tenant "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"

  Scenario: Browse organization identities from your own tenant
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/organizations"
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

  Scenario: Read an organization identity from an other tenant
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/organizations/123ea2f7-7869-45fc-975a-0392e889b488"
    Then the response status code should be 404
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON

  Scenario: Edit an organization identity from an other tenant
    When I add "Accept" header equal to "application/json"
    And I add "Content-Type" header equal to "application/json"
    And I send a "PUT" request to "/organizations/123ea2f7-7869-45fc-975a-0392e889b488" with body:
    """
    {}
    """
    Then the response status code should be 404
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON

  Scenario: Delete an organization identity from another tenant
    When I add "Accept" header equal to "application/json"
    And I send a "DELETE" request to "/organizations/123ea2f7-7869-45fc-975a-0392e889b488"
    Then the response status code should be 404
    And the header "Content-Type" should be equal to "application/json"
    And the response should be in JSON
