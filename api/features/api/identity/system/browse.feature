@api @identity @system @browse
Feature: Browse system identities

  Background:
    Given I am authenticated as the "system@system.ds" user from the tenant "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"

  Scenario: Browse all system identities
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/systems"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 1,
      "maxItems": 1,
      "items": {
        "type": "object",
        "properties": {
          "id": {
            "type": "integer"
          },
          "uuid": {
            "type": "string",
            "pattern": "[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}"
          },
          "createdAt": {
            "type": "string"
          },
          "updatedAt": {
            "type": "string"
          },
          "deletedAt": {
            "type": ["string", "null"]
          },
          "owner": {
            "type": "string"
          },
          "ownerUuid": {
            "type": "string",
            "pattern": "[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}"
          },
          "roles": {
            "type": "array"
          },
          "version": {
            "type": "integer"
          },
          "tenant": {
            "type": "string",
            "pattern": "[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}"
          }
        }
      },
      "required": [
        "id",
        "uuid",
        "createdAt",
        "updatedAt",
        "deletedAt",
        "owner",
        "ownerUuid",
        "roles",
        "version",
        "tenant"
      ]
    }
    """

  Scenario: Browse paginated system identities
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/systems?_page=1&_limit=1"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 1,
      "maxItems": 1
    }
    """

  Scenario: Browse system identities with a specific id
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/systems?id=1"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 1,
      "maxItems": 1
    }
    """

  Scenario: Browse system identities with specific ids
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/systems?id[0]=1"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 1,
      "maxItems": 1
    }
    """

  Scenario: Browse system identities with a specific uuid
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/systems?uuid=aa18b644-a503-49fa-8f53-10f4c1f8e3a1"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 1,
      "maxItems": 1
    }
    """

  Scenario: Browse system identities with specific uuids
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/systems?uuid[0]=aa18b644-a503-49fa-8f53-10f4c1f8e3a1"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 1,
      "maxItems": 1
    }
    """

  Scenario: Browse system identities with a specific owner
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/systems?owner=System"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 1,
      "maxItems": 1
    }
    """

  Scenario: Browse system identities with specific owners
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/systems?owner[0]=System"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 1,
      "maxItems": 1
    }
    """

  Scenario: Browse system identities with a specific owner uuid
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/systems?ownerUuid=aa18b644-a503-49fa-8f53-10f4c1f8e3a1"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 1,
      "maxItems": 1
    }
    """

  Scenario: Browse system identities with specific owner uuids
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/systems?ownerUuid[0]=aa18b644-a503-49fa-8f53-10f4c1f8e3a1"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 1,
      "maxItems": 1
    }
    """

  Scenario: Browse system identities with a specific before created date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/systems?createdAt[before]=2050-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 1,
      "maxItems": 1
    }
    """

  Scenario: Browse system identities with a specific after created date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/systems?createdAt[after]=2000-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 1,
      "maxItems": 1
    }
    """

  Scenario: Browse system identities with a specific before updated date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/systems?updatedAt[before]=2050-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 1,
      "maxItems": 1
    }
    """

  Scenario: Browse system identities with a specific after updated date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/systems?updatedAt[after]=2000-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 1,
      "maxItems": 1
    }
    """

  Scenario: Browse system identities with a specific before deleted date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/systems?deletedAt[before]=2050-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 0,
      "maxItems": 0
    }
    """

  Scenario: Browse system identities with a specific after deleted date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/systems?deletedAt[after]=2000-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the JSON should be valid according to this schema:
    """
    {
      "type": "array",
      "minItems": 0,
      "maxItems": 0
    }
    """
