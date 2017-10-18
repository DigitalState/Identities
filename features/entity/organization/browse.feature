@app @entity @organization @browse
Feature: Browse organizations
  In order to browse organizations
  As a system identity
  I should be able to send api requests related to organizations

  Background:
    Given I am authenticated as a "system" identity

  @createSchema @loadFixtures
  Scenario: Browse all organizations
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/organizations"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 1 items

  Scenario: Browse paginated organizations
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/organizations?page=1&limit=1"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 1 items

  Scenario: Browse organizations with a specific id
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/organizations?id=1"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 1 items

  Scenario: Browse organizations with specific ids
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/organizations?id[0]=1"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 1 items

  Scenario: Browse organizations with a specific uuid
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/organizations?uuid=605289e0-9371-42d4-b9fe-5308c348a6a4"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 1 items

  Scenario: Browse organizations with specific uuids
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/organizations?uuid[0]=605289e0-9371-42d4-b9fe-5308c348a6a4"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 1 items

  Scenario: Browse organizations with a specific owner
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/organizations?owner=BusinessUnit"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  Scenario: Browse organizations with specific owners
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/organizations?owner[0]=BusinessUnit"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 1 items

  Scenario: Browse organizations with a specific owner uuid
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/organizations?ownerUuid=a8357843-470d-4e3a-8014-5fec0306e017"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 1 items

  Scenario: Browse organizations with specific owner uuids
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/organizations?ownerUuid[0]=a8357843-470d-4e3a-8014-5fec0306e017"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 1 items

  Scenario: Browse organizations with a specific before created date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/organizations?createdAt[before]=2050-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 1 items

  Scenario: Browse organizations with a specific after created date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/organizations?createdAt[after]=2000-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 1 items

  Scenario: Browse organizations with a specific before updated date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/organizations?updatedAt[before]=2050-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 1 items

  Scenario: Browse organizations with a specific after updated date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/organizations?updatedAt[after]=2000-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 1 items

  Scenario: Browse organizations with a specific before deleted date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/organizations?deletedAt[before]=2050-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 1 items

  Scenario: Browse organizations with a specific after deleted date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/organizations?deletedAt[after]=2000-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 1 items

  Scenario: Browse organizations ordered by id asc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/organizations?order[id]=asc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  Scenario: Browse organizations ordered by id desc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/organizations?order[id]=desc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  Scenario: Browse organizations ordered by created date asc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/organizations?order[createdAt]=asc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  Scenario: Browse organizations ordered by created date desc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/organizations?order[createdAt]=desc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  Scenario: Browse organizations ordered by updated date asc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/organizations?order[updatedAt]=asc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  Scenario: Browse organizations ordered by updated date desc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/organizations?order[updatedAt]=desc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  Scenario: Browse organizations ordered by deleted date asc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/organizations?order[deletedAt]=asc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  Scenario: Browse organizations ordered by deleted date desc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/organizations?order[deletedAt]=desc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  Scenario: Browse organizations ordered by owner asc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/organizations?order[owner]=asc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  @dropSchema
  Scenario: Browse organizations ordered by owner desc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/organizations?order[owner]=desc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items
