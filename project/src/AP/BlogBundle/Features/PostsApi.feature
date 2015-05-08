Feature: Api for posts

  Scenario: I can get app posts
    Given there are following Posts:
      | title                 | pubDate    | content                                                                                                                                        |
      | Ukraine wins WC 2018. | 2018-05-12 | Vivamus suscipit tortor eget felis porttitor volutpat. Sed porttitor lectus nibh.                                                              |
      | First man on mars!!!. | 2016-09-14 | Donec sollicitudin molestie malesuada. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.                                   |
      | They did it.          | 2017-06-14 | Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Vivamus suscipit tortor eget felis porttitor volutpat.                            |
      | 100% profit engine.   | 2019-04-16 | Quisque velit nisi, pretium ut lacinia in, elementum id enim. Pellentesque in ipsum id orci porta dapibus.                                     |
      | Symfony 4 released.   | 2019-04-18 | Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. |
    When I make GET request to /en/blog/api/v1/posts.json
    And print last response
    Then the response status code should be 200




