Feature: Dashboard

In order to see system's state
As an Authenticated User
I need to be able to list the current user's projects and starreds

Scenario: Access dashboard as Anonynous user
    Given I am "Anonymous" user
    When I am on the dashboard
    Then I should get redirected to "/login"

Scenario: List last activity
    Given the homepage
    Given I am "test@users.com" user
    When I am on the dashboard
    Then I should get:
        """
        Some generated activity 1
        """

Scenario: List Starred projects
    Given the homepage
    Given I am "test@users.com" user
    When I am on the dashboard
    Then I should get:
        """
        My Starred Project 1
        """

Scenario: List User projects
    Given the homepage
    Given I am "test@users.com" user
    When I am on the dashboard
    Then I should get:
        """
        My Project 1
        """

