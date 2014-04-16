Feature: Project management

In order to manage my projects
As an Authenticated User
I need to create, update, delete and find projects

Scenario: Open create project view
    Given I am on the "/"
    Given I am "test@users.com" user
	Given I am on the "/dashboard"
	When I click the element "add_project"
	Then I should get redirected to "/project/new"
    Then I should get:
        """
        What do you want to incubate?
        """
	
Scenario: Find all projects
    Given I am on the "/"
    Given I am "test@uses.com" user
	When I visit "/project"
    Then I should get:
        """
        My test project
        """
	And The element "projects" should contain more than "1" element
	
Scenario: Create project
    Given I am on the "/"
    Given I am "test@users.com" user
	Given I visit "/project/new"
	When I set the field "name" with the value "Created Project"
	And I click the element "Create"
	Then I should get redirected to "/project/created-project"