@app @entity @staff @browse
Feature: Browse staffs
  In order to browse staffs
  As a system identity
  I should be able to send api requests related to staffs

  Background:
    Given I am authenticated as the "system" identity

  @createSchema @loadFixtures
  Scenario: Browse all staffs
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/staffs"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse paginated staffs
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/staffs?page=1&limit=1"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse staffs with a specific id
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/staffs?id=1"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse staffs with specific ids
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/staffs?id[0]=1"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse staffs with a specific uuid
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/staffs?uuid=06f8bb0b-45e3-46af-94c7-ff917f720c82"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse staffs with specific uuids
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/staffs?uuid[0]=06f8bb0b-45e3-46af-94c7-ff917f720c82"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse staffs with a specific owner
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/staffs?owner=BusinessUnit"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse staffs with specific owners
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/staffs?owner[0]=BusinessUnit"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse staffs with a specific owner uuid
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/staffs?ownerUuid=83bf8f26-7181-4bed-92f3-3ce5e4c286d7"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse staffs with specific owner uuids
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/staffs?ownerUuid[0]=83bf8f26-7181-4bed-92f3-3ce5e4c286d7"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse staffs with a specific before created date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/staffs?createdAt[before]=2050-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse staffs with a specific after created date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/staffs?createdAt[after]=2000-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse staffs with a specific before updated date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/staffs?updatedAt[before]=2050-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse staffs with a specific after updated date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/staffs?updatedAt[after]=2000-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse staffs with a specific before deleted date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/staffs?deletedAt[before]=2050-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse staffs with a specific after deleted date
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/staffs?deletedAt[after]=2000-01-01"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse staffs ordered by id asc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/staffs?order[id]=asc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse staffs ordered by id desc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/staffs?order[id]=desc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse staffs ordered by created date asc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/staffs?order[createdAt]=asc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse staffs ordered by created date desc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/staffs?order[createdAt]=desc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse staffs ordered by updated date asc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/staffs?order[updatedAt]=asc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse staffs ordered by updated date desc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/staffs?order[updatedAt]=desc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse staffs ordered by deleted date asc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/staffs?order[deletedAt]=asc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse staffs ordered by deleted date desc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/staffs?order[deletedAt]=desc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  Scenario: Browse staffs ordered by owner asc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/staffs?order[owner]=asc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items

  @dropSchema
  Scenario: Browse staffs ordered by owner desc
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/staffs?order[owner]=desc"
    Then the response status code should be 200
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the response should be in JSON
    And the response should be a collection
    And the response collection should count 1 items
