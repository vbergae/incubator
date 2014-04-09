Feature: Dashboard

In order to see system's state
As an Authenticated User
I need to be able to list the current user's projects and starreds

Scenario: List Starred projects
  When I am on the dashboard
  Then I should get:
    """
    My Starred Project 1
    """

Scenario: List User projects
  When I am on the dashboard
  Then I should get:
    """
    My Project 1
    """

