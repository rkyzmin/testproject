Инструкция:
1. зайти в корень папки test-project;
2. выполнить команду docker-compose up -d, после того, как композиция отработала, небоходимо войти в контейнер mysqlapp и создать базу 'kit' ИЛИ зайти в любую IDE под данными контейнера `mysqlapp`, хост - `localhost`;
3. зайти в папку 'www' выполнить в терминале команду "bash localdeploy.sh" - выполнятся миграции
4. перейти в проект - в адмиинку, логин и пароль: 
	- `admin`; 
	- `admin12345root`.

5. В админской части добавляем блоки.