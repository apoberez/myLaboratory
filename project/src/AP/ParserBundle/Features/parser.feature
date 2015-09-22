Feature: Parser

  @javascript
  Scenario: parser page available
    Given I am on "/admin/parser"
    Then I should see "Url to start"

#  Заповнення стартової форми:
   1. Кнопка задізейблена поки форма не заповнена
   2. Валідація поля

   Після початку парсингу:
   1. Збираю інформацію про каталог
   2. Виводжу на екран кількість продуктів в каталозі з опцією конфірма