@api @individual @browse
Feature: Browse individual identities
  In order to browse individual identities
  As a system identity
  I should be able to send api requests related to individual identities

  Background:
    Given I am authenticated as the "System" identity from the tenant "b6ac25fe-3cd6-4100-a054-6bba2fc9ef18"

  @createSchema @loadFixtures
  Scenario: Browse all individuals
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/individuals"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse paginated individuals
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/individuals?page=1&limit=1"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse individuals with a specific id
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/individuals?id=1"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse individuals with specific ids
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/individuals?id[0]=1"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse individuals with a specific uuid
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/individuals?uuid=9ce3bdb9-47e1-43c9-81ee-0dcc2106ba42"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse individuals with specific uuids
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/individuals?uuid[0]=9ce3bdb9-47e1-43c9-81ee-0dcc2106ba42"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse individuals with a specific owner
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/individuals?owner=BusinessUnit"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse individuals with specific owners
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/individuals?owner[0]=BusinessUnit"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse individuals with a specific owner uuid
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/individuals?ownerUuid=83bf8f26-7181-4bed-92f3-3ce5e4c286d7"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse individuals with specific owner uuids
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/individuals?ownerUuid[0]=83bf8f26-7181-4bed-92f3-3ce5e4c286d7"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse individuals with a specific before created date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/individuals?createdAt[before]=2050-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse individuals with a specific after created date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/individuals?createdAt[after]=2000-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse individuals with a specific before updated date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/individuals?updatedAt[before]=2050-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse individuals with a specific after updated date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/individuals?updatedAt[after]=2000-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse individuals with a specific before deleted date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/individuals?deletedAt[before]=2050-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse individuals with a specific after deleted date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/individuals?deletedAt[after]=2000-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse individuals ordered by id asc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/individuals?order[id]=asc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse individuals ordered by id desc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/individuals?order[id]=desc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse individuals ordered by created date asc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/individuals?order[createdAt]=asc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse individuals ordered by created date desc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/individuals?order[createdAt]=desc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse individuals ordered by updated date asc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/individuals?order[updatedAt]=asc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse individuals ordered by updated date desc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/individuals?order[updatedAt]=desc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse individuals ordered by deleted date asc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/individuals?order[deletedAt]=asc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse individuals ordered by deleted date desc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/individuals?order[deletedAt]=desc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse individuals ordered by owner asc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/individuals?order[owner]=asc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  @dropSchema
  Scenario: Browse individuals ordered by owner desc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/individuals?order[owner]=desc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items
