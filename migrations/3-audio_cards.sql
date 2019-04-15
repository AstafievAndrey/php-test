START TRANSACTION;

--
-- Структура таблицы `audio_cards`
--

CREATE TABLE `audio_cards` (
  `id` int(11) NOT NULL,
  `artist_id` int(11) NOT NULL COMMENT 'Ид артиста из таблицы artist.',
  `image_id` int(11) COMMENT 'Ид изображения из таблицы images(обложка альбома).',
  `name` varchar(255) NOT NULL COMMENT 'Название альбома.',
  `year` int(4) NOT NULL COMMENT 'Год выпуска.',
  `duration` int(11) NOT NULL COMMENT 'Длительность альбома.',
  `price` float(11) NOT NULL COMMENT 'Стоимость альбома.',
  `code` varchar(255) NOT NULL COMMENT 'Код хранилища (номер комнаты : номер стойки : номер полки).',
  `purchase_date` datetime NOT NULL COMMENT 'Дата покупки.',

  `create_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `delete_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы таблицы `audio_card`
--

ALTER TABLE `audio_cards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk-audio_cards-code` (`code`),
  ADD KEY `fk-audio_cards-image_id` (`image_id`),
  ADD KEY `fk-audio_cards-artist_id` (`artist_id`);

--
-- Ограничения внешнего ключа таблицы `audio_cards`
--

ALTER TABLE `audio_cards`
  ADD CONSTRAINT `fk-audio_cards-image_id` FOREIGN KEY (`image_id`) REFERENCES `images` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-audio_cards-artist_id` FOREIGN KEY (`artist_id`) REFERENCES `artists` (`id`) ON DELETE CASCADE;

--
-- AUTO_INCREMENT для таблицы `audio_card`
--

ALTER TABLE `audio_cards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

COMMIT;