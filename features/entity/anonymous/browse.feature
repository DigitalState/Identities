@app @entity @anonymous @browse
Feature: Browse anonymouses
  In order to browse anonymouses
  As a system identity
  I should be able to send api requests related to anonymouses

  Background:
    Given I am authenticated as the "system" identity

  @createSchema @loadFixtures
  Scenario: Browse all anonymouses
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/anonymouses"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse paginated anonymouses
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/anonymouses?page=1&limit=1"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse anonymouses with a specific id
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/anonymouses?id=1"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse anonymouses with specific ids
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/anonymouses?id[0]=1"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse anonymouses with a specific uuid
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/anonymouses?uuid=73aab537-f174-4bf9-b986-afedbb23b7bc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse anonymouses with specific uuids
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/anonymouses?uuid[0]=73aab537-f174-4bf9-b986-afedbb23b7bc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse anonymouses with a specific owner
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/anonymouses?owner=BusinessUnit"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse anonymouses with specific owners
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/anonymouses?owner[0]=BusinessUnit"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse anonymouses with a specific owner uuid
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/anonymouses?ownerUuid=325e1004-8516-4ca9-a4d3-d7505bd9a7fe"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse anonymouses with specific owner uuids
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/anonymouses?ownerUuid[0]=325e1004-8516-4ca9-a4d3-d7505bd9a7fe"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse anonymouses with a specific before created date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/anonymouses?createdAt[before]=2050-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse anonymouses with a specific after created date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/anonymouses?createdAt[after]=2000-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse anonymouses with a specific before updated date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/anonymouses?updatedAt[before]=2050-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse anonymouses with a specific after updated date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/anonymouses?updatedAt[after]=2000-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse anonymouses with a specific before deleted date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/anonymouses?deletedAt[before]=2050-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse anonymouses with a specific after deleted date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/anonymouses?deletedAt[after]=2000-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse anonymouses ordered by id asc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/anonymouses?order[id]=asc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse anonymouses ordered by id desc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/anonymouses?order[id]=desc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse anonymouses ordered by created date asc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/anonymouses?order[createdAt]=asc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse anonymouses ordered by created date desc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/anonymouses?order[createdAt]=desc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse anonymouses ordered by updated date asc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/anonymouses?order[updatedAt]=asc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse anonymouses ordered by updated date desc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/anonymouses?order[updatedAt]=desc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse anonymouses ordered by deleted date asc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/anonymouses?order[deletedAt]=asc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse anonymouses ordered by deleted date desc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/anonymouses?order[deletedAt]=desc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse anonymouses ordered by owner asc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/anonymouses?order[owner]=asc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  @dropSchema
  Scenario: Browse anonymouses ordered by owner desc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/anonymouses?order[owner]=desc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items
