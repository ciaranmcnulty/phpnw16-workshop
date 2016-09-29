Feature: Applying VAT and delivery costs to basket
  In order to know how much I'm paying
  As a customer
  I need VAT and cost of delivery to be calculated based on my basket price

  Rules:
  - VAT is 20%
  - Delivery cost for basket >= £10 is £2
  - Delivery cost for basket < £10 is £3

  @critical
  Scenario: Product costing less than £10 results in delivery cost of £3
    Given there is a product with SKU "RS1"
    And this product is listed at a cost of £5 in the catalogue
    When I add this product to my basket from the catalogue
    Then the total cost of my basket should be £9

  Scenario: Product costing more than £10 results in delivery cost of £2
    Given there is a product with SKU "RS1"
    And this product is listed at a cost of £10 in the catalogue
    When I add this product to my basket from the catalogue
    Then the total cost of my basket should be £14
