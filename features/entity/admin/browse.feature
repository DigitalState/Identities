@app @entity @admin @browse
Feature: Browse admins
  In order to browse admins
  As an admin identity
  I should be able to send api requests related to admins

  Background:
    Given I am authenticated as an "admin" identity

  @createSchema @loadFixtures
  Scenario: Browse all admins
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/admins"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 1 items

  Scenario: Browse paginated admins
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/admins?page=1&limit=1"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 1 items

  Scenario: Browse admins with a specific id
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/admins?id=1"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 1 items

  Scenario: Browse admins with specific ids
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/admins?id[0]=1"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 1 items

  Scenario: Browse admins with a specific uuid
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/admins?uuid=b163571a-d4b9-4b72-9827-4178301a1a24"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 1 items

  Scenario: Browse admins with specific uuids
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/admins?uuid[0]=b163571a-d4b9-4b72-9827-4178301a1a24"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 1 items

  Scenario: Browse admins with a specific owner
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/admins?owner=BusinessUnit"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  Scenario: Browse admins with specific owners
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/admins?owner[0]=BusinessUnit"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 1 items

  Scenario: Browse admins with a specific owner uuid
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/admins?ownerUuid=d5de44e0-d727-4f69-a8b3-c3afbf75eda3"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 1 items

  Scenario: Browse admins with specific owner uuids
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/admins?ownerUuid[0]=d5de44e0-d727-4f69-a8b3-c3afbf75eda3"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 1 items

  Scenario: Browse admins with a specific before created date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/admins?createdAt[before]=2050-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 1 items

  Scenario: Browse admins with a specific after created date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/admins?createdAt[after]=2000-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 1 items

  Scenario: Browse admins with a specific before updated date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/admins?updatedAt[before]=2050-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 1 items

  Scenario: Browse admins with a specific after updated date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/admins?updatedAt[after]=2000-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 1 items

  Scenario: Browse admins with a specific before deleted date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/admins?deletedAt[before]=2050-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 1 items

  Scenario: Browse admins with a specific after deleted date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/admins?deletedAt[after]=2000-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 1 items

  Scenario: Browse admins ordered by id asc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/admins?order[id]=asc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  Scenario: Browse admins ordered by id desc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/admins?order[id]=desc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  Scenario: Browse admins ordered by created date asc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/admins?order[createdAt]=asc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  Scenario: Browse admins ordered by created date desc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/admins?order[createdAt]=desc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  Scenario: Browse admins ordered by updated date asc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/admins?order[updatedAt]=asc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  Scenario: Browse admins ordered by updated date desc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/admins?order[updatedAt]=desc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  Scenario: Browse admins ordered by deleted date asc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/admins?order[deletedAt]=asc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  Scenario: Browse admins ordered by deleted date desc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/admins?order[deletedAt]=desc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  Scenario: Browse admins ordered by owner asc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/admins?order[owner]=asc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items

  @dropSchema
  Scenario: Browse admins ordered by owner desc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/admins?order[owner]=desc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
#    And the response JSON should be a collection
#    And the response collection should count 2 items
