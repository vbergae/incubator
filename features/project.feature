Feature: Project management

In order to manage my projects
As an Authenticated User
I need to create, update, delete and find projects

Scenario: Open create project view
    Given I am "test@users.com" user
	Given I am on the dasboard
	When I click "add_project" button
	Then I should get redirected to "/project/new/"
	
Scenario: Find all projects
    Given I am "test@uses.com" user
	When I visit "/project"
	Then I should see "projects" element
	And The element "projects" should contain more than "1" element
	
Scenario: Create project
    Given I am "test@users.com" user
	Given I visit "/project/new"
	When I set the field "name" with the value "Created Project"
	And I click the element "Create"
	Then I should get redirected to "/project/created-project"