START TRANSACTION;

--
-- Структура таблицы `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL COMMENT 'Название файла.',
  `type` text NOT NULL COMMENT 'Тип файла.',
  `size` int(11) NOT NULL COMMENT 'Размер файла.',
  `blob` blob NOT NULL COMMENT 'Ячейка с файлом.',
  `create_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `delete_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы таблицы `images`
--

ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);


--
-- AUTO_INCREMENT для таблицы `images`
--

ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

