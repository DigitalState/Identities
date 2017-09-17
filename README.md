# Identities

The DigitalState Identities microservice provides the storage and control for Government Identities:

1. Individuals
1. Organizations
1. Staff
1. Business Units
1. Systems
1. Anonymous

The identities microservice does not contain any authentication mechanism for logging in as a Individual, Organization or Staff.  All Authentication activities are preforms by the [DigitalState Authentication Microservice](https://github.com/DigitalState/Authentication)

## Table of Contents

- [Synopsis](#synopsis)
- [Installation](#installation)
- [Documentation](#documentation)
- [Contributing](#contributing)
- [History](#history)
- [Credits](#credits)

## Synopsis

Individuals and Organizations are the "citizen" facing identities which store one or more persona.

Staff and Business Units are the Government Staffer's identities.  Staff have a persona, and Business Units are used to represent a government's organizational structure.

Permissions are stored against a Identity: The actions an Individual, Organization, or Staffer can make across the DigitalState platform are based on the permissions saved against the Identity.

### Persona

A Persona is a JSON based data structure that represents the Individual, Organization, Staffer, or Business Unit.  A minimum of one persona is required, but many persona can be activated allowing, for example, Individuals and Organizations to personify many Identities.

A common use case in government business is an Individual who has a married name and a non-married name, or a individual may present a different home addresses depending on the government service and/or department.

Persona can be extended with privacy and sharing controls allowing a Identity to select which government departments and agencies can view their persona on a one-time or continual basis.

#### Persona Definitions

Persona are enabled with Definition control structures that are JSON-Schema based.  These schema control what data can be added into the JSON based persona.  Different definitions can be used for different persona requirements such as a Individual having a "Primary" and "Secondary" persona, and the "primary" persona is basic information that is all required fields, and the "secondary" persona is more extensive number of fields, but are all optional.

### Individuals

An Individual is a person.  A person in government business typically represents a Citizen, Resident, or Tourist.

### Organizations

An Organization is typically a business or non-profit organization.  A business typically is configured to require at least one Individual to be a 'member' or 'owner' of the organization.

### Staff

Staff (also referred to as a 'staffer') is the government employee who carries out government business.  A staffer is typically a government employee, contractor, agency representative, or a third-party that a government has empowered to preform business activities on the government's behalf.

### Business Units

A Business Unit is a flat or hierarchical representation of a business group inside of a government.  Common Business units include: departmental structures, call centre/311 management structures, service ownership structures, and multi-government, multi-agency management structures.

Business Units are typically used as a 'owner' for various data in other DigitalState microservices.  A best practice is to ensure that ownership is assigned to a Business Unit rather than a Staffer.

Business Units can be thought of as "groups" but a business unit is much more business oriented and enabled with persona, and other control features.

### Systems

Systems are "Service Accounts" that typically are system-to-system interactions.

### Anonymous

Anonymous (sometimes referred to Anonymous Contacts) is anyone or anything that interacts with the DigitalState API.  Depending on the configuration of the security, all Anonymous can require a JWT token.  Anonymous can also be given a Persona to store data about the Anonymous. The Persona can additionally allow future reconciliation of Individual's and Organiations with past Anonymous activity:
Example usage:  An Individual creates 3 service requests as a Anonymous, and later creates a Individual
s Account.  Using Anonymous Personas', the Anonymous Activity can be related/linked/consolidated to the Individual's new account.

## Installation

Run docker.

```
docker-compose up -d
```

Run database migrations.

```
docker-compose exec php php bin/console doctrine:migrations:migrate
```

Run dev data fixtures (optional).

```
docker-compose exec php php bin/console doctrine:fixtures:load
```

## Documentation

Documentation...

## Contributing

Please read [CONTRIBUTING.md](CONTRIBUTING.md) for details on our code of conduct, and the process for submitting pull requests to us.

## History

History..

## Credits

Credits...
