-- Insert data for provinces
INSERT INTO `provinces` (`provinceID`, `provinceName`) VALUES
(1, 'Batangas'),
(2, 'Laguna'),
(3, 'Metro Manila'),
(4, 'Cebu'),
(5, 'Davao del Sur'),
(6, 'Surigao del Norte');

-- Insert data for cities
INSERT INTO `cities` (`cityID`, `cityName`) VALUES
(1, 'Tanauan City'),
(2, 'Calamba City'),
(3, 'Talisay'),
(4, 'Quezon City'),
(5, 'Cebu City'),
(6, 'Davao City'),
(7, 'Siargao');

-- Insert data for address (linked to cities and provinces)
INSERT INTO `address` (`addressID`, `cityID`, `provinceID`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 1),
(4, 4, 3),
(5, 5, 4),
(6, 6, 5),
(7, 7, 6);

-- Insert data for users
INSERT INTO `users` (`userID`, `messageID`) VALUES
(1, NULL),
(2, NULL),
(3, NULL),
(4, NULL),
(5, NULL),
(6, NULL);

-- Insert data for userinfo
INSERT INTO `userinfo` (`userInfoID`, `userID`, `addressID`, `firstName`, `lastName`, `email`, `birthDate`) VALUES
(1, 1, 1, 'Mark Louie', 'Villanueva', 'marklouie@gmail.com', '2004-03-12'),
(2, 2, 1, 'Tristan Matthew', 'Matencio', 'tristanmatthew@gmail.com', '2004-04-20'),
(3, 3, 2, 'Jade', 'Bernardo', 'jadebernardo@gmail.com', '2004-08-01'),
(4, 4, 1, 'Rejoice', 'Rabino', 'rejoicerabino@gmail.com', '2004-08-20'),
(5, 5, 3, 'Denise', 'Suarez', 'denisesuarez@gmail.com', '2004-08-05'),
(6, 6, 3, 'Yana', 'Abello', 'yaneabello@gmail.com', '2003-12-27');

-- Insert data for posts
INSERT INTO `posts` (`postID`, `userID`, `content`, `dateTime`, `privacy`, `isDeleted`, `attachment`, `addressID`) VALUES
(1, 4, 'Enjoying the sunset at Manila Bay!', '2024-10-20 13:45:00', 'public', 0, NULL, 4),
(2, 2, 'Had a great time at Cebu IT Park with friends.', '2024-10-26 09:15:00', 'public', 0, NULL, 5),
(3, 3, 'Exploring the mountains of Davao!', '2024-10-26 12:30:00', 'friends', 0, NULL, 6),
(4, 1, 'Chilling in the summer🐚', '2024-03-3 11:30:00', 'friends', 0, NULL, 7);


-- Insert data for comments
INSERT INTO `comments` (`commentID`, `dateTime`, `content`, `userID`, `postID`) VALUES
(1, '2024-10-26 10:00:00', 'Looks fun! Wish I could join.', 1, 2),
(2, '2024-10-26 14:00:00', 'Amazing view!', 2, 3),
(3, '2024-03-15 07:00:00', 'What a relaxing vacation, I really miss visiting my cousin there', 3, 1),
(4, '2024-03-15 07:30:00', 'Whos that girl behind you, bruh?🤔', 3, 1),
(5, '2024-10-27 17:19:00', 'I wonder how much the ticket flight to Cebu🤔', 4, 2);

-- Insert data for friends
INSERT INTO `friends` (`friendID`, `requesterID`, `requesteeID`, `status`) VALUES
(1, 1, 2, 'accepted'),
(2, 1, 3, 'accepted'),
(3, 2, 3, 'accepted'),
(4, 4, 1, 'accepted'),
(5, 1, 6, 'pending'),
(6, 3, 6,  'accepted'),
(7, 5, 6,  'accepted'),
(8, 4, 6,  'accepted'),
(9, 2, 4,  'pending'),
(10, 2, 5,  'accepted'),
(11, 4, 5, 'accepted');

-- Insert data for closefriends (indicating user-defined close friends)
INSERT INTO `closefriends` (`closeFriendID`, `ownerID`, `userID`) VALUES
(1, 1, 2), 
(2, 2, 1), 
(3, 2, 3),
(3, 3, 1);

-- Insert data for reactions
INSERT INTO `reactions` (`reactionID`, `userID`, `postID`, `kind`, `commentID`) VALUES
(1, 1, 2, 'like', NULL),
(2, 2, 3, 'like', NULL),
(3, 3, 2, 'like', NULL),
(4, 4, 2, 'like', NULL),
(5, 2, 4, 'like', NULL),
(6, 2, 4, 'like', NULL),
(7, 5, 2, 'like', NULL),
(8, 1, 4, 'like', NULL);

