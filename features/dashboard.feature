Feature: Dashboard

In order to see system's state
As an Authenticated User
I need to be able to list the current user's projects and starreds

Scenario: List 10 starred projects
  When I am on the dashboard
  Then I should get:
    """
    My Starred Project 1
    My Starred Project 2
    My Starred Project 3
    My Starred Project 4
    My Starred Project 5
    My Starred Project 6
    My Starred Project 7
    My Starred Project 8    
    My Starred Project 9
    My Starred Project 10
    """

