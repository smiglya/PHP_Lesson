<?php
$books = [];
$readers = [];
$nextBookId = 1;
$nextReaderId = 1;

// Функция для добавления новой книги
function addBook() {
    global $books, $nextBookId;
    
    $title = readline("Введите название книги: ");
    $author = readline("Введите автора книги: ");
    $year = readline("Введите год издания: ");
    
    $books[$nextBookId] = [
        'id' => $nextBookId,
        'title' => $title,
        'author' => $author,
        'year' => $year,
        'status' => 'в наличии'
    ];
    
    $nextBookId++;
    echo "Книга успешно добавлена.\n";
}

// Функция для обновления информации о книге
function updateBook() {
    global $books;
    
    $id = readline("Введите ID книги для обновления: ");
    
    if (!isset($books[$id])) {
        echo "Книга с указанным ID не найдена.\n";
        return;
    }
    
    $title = readline("Введите новое название книги: ");
    $author = readline("Введите нового автора: ");
    $year = readline("Введите новый год издания: ");
    
    $books[$id]['title'] = $title;
    $books[$id]['author'] = $author;
    $books[$id]['year'] = $year;
    
    echo "Книга успешно обновлена.\n";
}

// Функция для удаления книги
function deleteBook() {
    global $books;
    
    $id = readline("Введите ID книги для удаления: ");
    
    if (!isset($books[$id])) {
        echo "Книга с указанным ID не найдена.\n";
        return;
    }
    
    unset($books[$id]);
    echo "Книга успешно удалена.\n";
}

// Функция для вывода списка всех книг
function listBooks() {
    global $books;
    
    if (empty($books)) {
        echo "Книг нет.\n";
        return;
    }
    
    foreach ($books as $book) {
        echo "ID: {$book['id']} - Название: {$book['title']} - Автор: {$book['author']} - Год: {$book['year']} - Статус: {$book['status']}\n";
    }
}

// Функция для регистрации нового читателя
function addReader() {
    global $readers, $nextReaderId;
    
    $name = readline("Введите имя читателя: ");
    
    $readers[$nextReaderId] = [
        'id' => $nextReaderId,
        'name' => $name
    ];
    
    $nextReaderId++;
    echo "Читатель успешно зарегистрирован.\n";
}

// Функция для выдачи книги читателю
function issueBook() {
    global $books, $readers;
    
    $bookId = readline("Введите ID книги: ");
    $readerId = readline("Введите ID читателя: ");
    
    if (!isset($books[$bookId]) || !isset($readers[$readerId])) {
        echo "Книга или читатель с указанным ID не найдены.\n";
        return;
    }
    
    if ($books[$bookId]['status'] === 'выдана') {
        echo "Книга уже выдана.\n";
        return;
    }
    
    $books[$bookId]['status'] = 'выдана';
    $books[$bookId]['reader_id'] = $readerId;
    
    echo "Книга успешно выдана.\n";
}

// Функция для возврата книги в библиотеку
function returnBook() {
    global $books;
    
    $bookId = readline("Введите ID книги: ");
    
    if (!isset($books[$bookId])) {
        echo "Книга с указанным ID не найдена.\n";
        return;
    }
    
    if ($books[$bookId]['status'] === 'в наличии') {
        echo "Книга уже в наличии.\n";
        return;
    }
    
    $books[$bookId]['status'] = 'в наличии';
    unset($books[$bookId]['reader_id']);
    
    echo "Книга успешно возвращена.\n";
}

// Главная функция
function main() {
    while (true) {
        echo "\nВыберите действие:\n";
        echo "1. Добавить книгу\n";
        echo "2. Обновить информацию о книге\n";
        echo "3. Удалить книгу\n";
        echo "4. Показать все книги\n";
        echo "5. Зарегистрировать читателя\n";
        echo "6. Выдать книгу читателю\n";
        echo "7. Вернуть книгу\n";
        echo "8. Выход\n";

        $choice = readline("Введите номер действия: ");

        switch ($choice) {
            case 1:
                addBook();
                break;
            case 2:
                updateBook();
                break;
            case 3:
                deleteBook();
                break;
            case 4:
                listBooks();
                break;
            case 5:
                addReader();
                break;
            case 6:
                issueBook();
                break;
            case 7:
                returnBook();
                break;
            case 8:
                echo "Выход из программы.\n";
                exit();
            default:
                echo "Неверный выбор. Попробуйте снова.\n";
        }
    }
}

// Запуск программы
main();
?>