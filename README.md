# Synology Pushbullet

Pushbullet SMS Provider wrapper for Synology Surveillance Station

## Installation

Run `composer install`, and run `cp .env.example .env`. After this, edit the
`.env` file to match your configuration.

## Usage

Add an SMS provider in Surveillance Station, use fake GET keys if necessary
for mapping (these will not be used).

```
http://my.domain/synology-pushbullet/?username=&password=&tel=&token=&text=
```
