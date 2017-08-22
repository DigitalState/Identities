@app @entity @system @browse
Feature: Browse systems
  In order to browse systems
  As an admin identity
  I should be able to send api requests related to systems

  Background:
    Given I am authenticated as an "admin" identity

  @createSchema @loadFixtures
  Scenario: Browse all systems
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/systems"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 1 items

  Scenario: Browse paginated systems
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/systems?page=1&limit=1"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 1 items

  Scenario: Browse systems with a specific id
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/systems?id=1"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 1 items

  Scenario: Browse systems with specific ids
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/systems?id[0]=1"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 1 items

  Scenario: Browse systems with a specific uuid
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/systems?uuid=5386e249-8ad0-45f1-a30e-d5a055cc5993"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 1 items

  Scenario: Browse systems with specific uuids
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/systems?uuid[0]=5386e249-8ad0-45f1-a30e-d5a055cc5993"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 1 items

  Scenario: Browse systems with a specific owner
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/systems?owner=BusinessUnit"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  Scenario: Browse systems with specific owners
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/systems?owner[0]=BusinessUnit"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 1 items

  Scenario: Browse systems with a specific owner uuid
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/systems?ownerUuid=d5de44e0-d727-4f69-a8b3-c3afbf75eda3"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 1 items

  Scenario: Browse systems with specific owner uuids
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/systems?ownerUuid[0]=d5de44e0-d727-4f69-a8b3-c3afbf75eda3"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 1 items

  Scenario: Browse systems with a specific before created date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/systems?createdAt[before]=2050-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 1 items

  Scenario: Browse systems with a specific after created date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/systems?createdAt[after]=2000-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 1 items

  Scenario: Browse systems with a specific before updated date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/systems?updatedAt[before]=2050-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 1 items

  Scenario: Browse systems with a specific after updated date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/systems?updatedAt[after]=2000-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 1 items

  Scenario: Browse systems with a specific before deleted date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/systems?deletedAt[before]=2050-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 1 items

  Scenario: Browse systems with a specific after deleted date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/systems?deletedAt[after]=2000-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 1 items

  Scenario: Browse systems ordered by id asc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/systems?order[id]=asc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  Scenario: Browse systems ordered by id desc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/systems?order[id]=desc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  Scenario: Browse systems ordered by created date asc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/systems?order[createdAt]=asc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  Scenario: Browse systems ordered by created date desc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/systems?order[createdAt]=desc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  Scenario: Browse systems ordered by updated date asc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/systems?order[updatedAt]=asc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  Scenario: Browse systems ordered by updated date desc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/systems?order[updatedAt]=desc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  Scenario: Browse systems ordered by deleted date asc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/systems?order[deletedAt]=asc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  Scenario: Browse systems ordered by deleted date desc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/systems?order[deletedAt]=desc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  Scenario: Browse systems ordered by owner asc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/systems?order[owner]=asc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  @dropSchema
  Scenario: Browse systems ordered by owner desc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/systems?order[owner]=desc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items
