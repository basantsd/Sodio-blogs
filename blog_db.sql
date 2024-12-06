-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 06, 2024 at 01:14 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(21) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Technology', NULL, NULL),
(2, 'Lifestyle', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(21) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `post_id` int(11) UNSIGNED NOT NULL,
  `comment` text NOT NULL,
  `is_approved` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `post_id`, `comment`, `is_approved`, `created_at`, `updated_at`) VALUES
(1, 2, 4, 'Hello My Commnet', 'approved', '2024-12-06 11:14:38', '2024-12-06 11:47:49'),
(2, 2, 3, 'asdasdasd', 'approved', '2024-12-06 11:57:19', '2024-12-06 11:57:41');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(21) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `category_id` bigint(21) DEFAULT NULL,
  `publish_date` date DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `slug`, `image`, `description`, `category_id`, `publish_date`, `status`, `created_at`, `updated_at`) VALUES
(1, 'The Wednesday Phenomenon: Who is Jenna Ortega', 'the-wednesday-phenomenon-who-is-jenna-ortega', 'Screenshot 2024-12-06 at 4.03.56 PM.png', 'Wednesday Is Making and Breaking Records\r\n\r\nDirected by Tim Burton, this Addams Family spin-off managed to become the second most-watched English-language series on Netflix. It even beat the 4th season of the all-popular Stranger Things.\r\n\r\nAfter premiering on November 23, 2022, Wednesday immediately began breaking records. It’s impossible to scan your Instagram or TikTok feed without watching someone mimic Wednesday’s unique image.\r\n\r\nEven Lady Gaga managed to recreate the crazy dance from the show and get millions of views on TikTok and YouTube.\r\n\r\nWhile Tim Burton is definitely the mastermind behind this record-breaking series, it would never become a phenomenon without Jenna Ortega who masterfully portrays Wednesday Addams.\r\nHow Old Is Jenna Ortega?\r\n\r\nJenna’s character, the titular Wednesday Addams, is 15 (later turns 16) in the series. Meanwhile, the actress recently turned 20. Born in California, on September 27, 2002, Jenna has Mexican and Puerto Rican ancestry. That’s where her beautiful looks and celebrity-worthy last name come from. Yes, that’s her real name.\r\n\r\nOrtega grew up with five siblings. When she turned six, she knew exactly what she wanted. Her goal was to become famous, and she achieved it with flying colors with the support of her family. Over the past 10 years, Ortega has been landing excellent and deep roles in movies, shows, and TV series.\r\n\r\nThe young actress has an impressive number of awards and nominations. The latest nomination is for Golden Globe’s Best Television Actress – Musical/Comedy Series Award for her role as Wednesday.\r\nHow Rich is Jenna Ortega?\r\n\r\nThe overwhelming popularity must have brought the lead actress a fortune, right? Of course, she didn’t play Wednesday Addams for pennies. The real figure is still a secret. Is it millions? Not likely.\r\n\r\nSince Jenna Ortega isn’t a show business newbie, she is likely to be making a significant amount. However, since she signed a contract before it became obvious that the show was a huge hit, the numbers may have been between $20,000 and $60,000 per episode.\r\n\r\nNow that the show’s popularity has gone through the roof, the actress is expected to make millions. For example, next season, the main Stranger Things actors plan to make between $6 million and $9 million.\r\n\r\nToday, Jenna’s net worth is $3 million. This is bound to change when she monetizes her 2nd season Wednesday contract. In fact, Netflix already announced the second season of its hit series. You can even watch the trailer.\r\nA Child Star: Jenna Ortega’s 10-Year Career\r\n\r\nJenna is hardly a new face on TV, social media, and movie screens. Ortega landed her first TV role back in 2012 in an episode of Rob. Back then, she was just 10 years old. Her first important role in TV series came in 2015 when she became Darcy (the main character’s best friend) in Netflix’s Richie Rich.\r\n\r\nIn 2016, Ortega got one of her best roles in Disney Channel’s sitcom TV Series Stuck in the Middle. She did an excellent job portraying the middle child in a family with seven kids. After all, it kind of mimicked her real-life experience.\r\n\r\nOn the movie screen, Ortega conquered the audience as Tara Carpenter in Scream (2021). She even won an MTV Movie &amp; TV Award for the Most Frightening Performance.\r\n\r\nJenna is also a social media guru. Wednesday brought her a whopping 10 million new followers on Instagram, doubling her existing audience almost immediately. Today, she has almost 40 million followers.  \r\nIs Jenna Ortega Dating Someone?\r\n\r\nJenna acted extremely naturally in Wednesday’s love triangle. But what’s up with her real love life? Being a celebrity for over a decade comes with many nuances, including hard-to-keep secrets. \r\n\r\nMeanwhile, over the past years, even the most experienced paparazzi didn’t manage to find out who Ortega was dating. Is it possible that she never dated anyone?\r\n\r\nOrtega is either a big professional at hiding her private life, or she’s not dating anyone right now either. That’s probably because the girl is extremely busy with work. She just finished filming the first season of Wednesday and already plans to work on the second one.\r\n\r\nIn 2022, this busy actress worked on four different movies. In 2023, fans expect to see her in Scream IV.\r\n\r\nOverall, Jenna’s personal life remains hidden from the public eye. However, her immense popularity after Wednesday’s release makes it extremely hard to remain hidden. Most likely, you’ll hear about her dating schedule in the nearest future.\r\nJenna Ortega is No Longer Vegan\r\n\r\nMany Ortega fans worry about her dietary choices. After all, she has been vegan for quite some time. Everything changed when this talented actress landed the role of Wednesday Addams. Why? Because she had to go to Romania to film the series.\r\n\r\nThe food options in Romania were so different from what Jenna preferred in the past that she had to make some changes to keep up.\r\n\r\nWhile she stopped being vegan, Jenna keeps the meat out of her diet. The actress calls herself a pescatarian (a vegan who eats seafood).\r\nWhat’s Next for Jenna Ortega?\r\n\r\nJenna is a hard-working actress who manages to juggle several projects simultaneously. Sometimes she regrets missing such ordinary things as prom or high school dances (ha-ha, she made up for that, didn’t she?).\r\n\r\nHowever, this doesn’t keep the young woman from pursuing a successful acting career, winning awards, and bringing new exciting projects to life.', 2, '2024-12-07', 'active', '2024-12-06 10:51:41', '2024-12-06 10:37:16'),
(2, 'What’s Going on With Elon Musk at Twitter?', 'what-s-going-on-with-elon-musk-at-twitter', 'Screenshot 2024-12-06 at 4.07.56 PM.png', 'Controversial, billionaire playboy, the world’s richest man, and now solo Twitter executive—Elon Musk is nothing if not eccentric. A few days after completing his extravagant buyout of Twitter Inc., Musk has been making global waves.\r\n\r\nTo say that things have been interesting would be an understatement. The first thing Elon Musk did was dissolve Twitter’s board and fire top executives. And, amid grand promises of promoting free speech, the billionaire has now rolled up his sleeves to turn Twitter upside down.\r\n\r\nWhat the heck is going on with the king of Twitter, Tesla, SpaceX, and the Boring Company? Is there a method to his madness, or is he just winging it and hoping it works?\r\nYou’re Fired! Musk’s Whirlwind Approach\r\n\r\nIn addition to the board and top executives, Musk has fired over 3,700 Twitter employees. According to him, the company is losing $4m a day. To save the company, he intends to stem the bleeding of funds and even slash $1B from the company’s infrastructure costs.\r\n\r\nOn the Friday of 4th November, Musk fired 50% of the tech giant’s employees via email, including many critical engineering and content moderation teams. In a later meeting, Musk said that he “had no choice.”\r\n\r\nThose who survived the layoffs were hardly better off, being required to work 12 hours a day with some sleeping in office couches to meet Musk’s grueling deadlines. And that’s despite Musk wanting to revamp Twitter’s policies and bring in new features on a tight timeline.\r\n\r\nIs Musk trying to realize his grand vision with less than half the workforce? There has been an interesting turn of events as he later asked some of the employees he fired to “please come back” because they’re essential to the company and the new features he’s working on.\r\n\r\nIt goes to show how reckless Musk has been in his first few weeks at the helm of what is one of the world’s most influential social media platforms. Not that he’s shying away from controversy and Twitter wars.\r\nTweeting Through the Storm\r\n\r\nDespite being the solo top dog at Twitter and simultaneously running his other companies, Musk has ramped up his activity on Twitter, spitting out more than 25 tweets a day. That’s a lot even for him, with his most recent tweets ranging from beefing with Jack Dorsey to making masturbation jokes.\r\n\r\nMusk’s Twitter account has been pretty interesting lately. He named himself “Chief Twit” on his profile and later, “Twitter Complaint Hotline Operator.” On Sunday, he contributed to a conspiracy theory arguing that birds aren’t real; they’re robots that spy on us. \r\n\r\nThe Atlantic calls Musk’s tweeting an “exhausting, enraging, grimly hilarious spectacle.” Musk’s first tweet after completing the takeover was, “the bird is freed.” This supposed liberation seems to be the proliferation of misinformation, propaganda, and extremist filth.\r\n\r\nAfter all, Musk wants to protect free speech, never mind if it’s offensive or outrightly subversive. Then, he decided that Twitter will sell the blue verification checkmark for $8 a month and told complainers, “please continue complaining, but it will cost you $8.”\r\nChanging the Verification System and More\r\n\r\nOriginally, Twitter gave a blue checkmark to notable people, such as politicians and celebrities after verifying their identities. It was a way to prevent impersonation and misinformation, but now Musk wants to give the verified check mark to anyone who can pay.\r\n\r\nA lot of people are unhappy and angry at Musk, especially since he’s passing off the subscription service as a solution to the “lords and peasants system” for who has or hasn’t the checkmark.\r\n\r\nThis premium version of Twitter, called Twitter Blue, will be expanded into other countries such as Australia and New Zealand. Musk has also been considering other ideas, many of which he’s floated on the platform. They include:\r\n\r\n    Bringing back Vine, a TikTok-like video-sharing platform by Twitter that was shut down in 2016\r\n    splitting the platform into tiers of content so that users can select what version they want\r\n    Allowing Twitter Blue users to post longer videos, up to 40 minutes long, and eventually removing the time limit\r\n    Charging people for watching video content, with Twitter getting a cut from the proceeds\r\n    Forming a committee to review Twitter’s policy on content moderation and possible reinstatement of banned accounts, such as Donald Trump\r\n    Revamp the search function\r\n    Monetize other forms of content\r\n    Allow users to attach long-form texts\r\n\r\nMusk has floated many more ideas through his tweets, many being fantastical and some highly controversial—all in a day’s work.\r\nTwitter is Dealing With a Massive Drop in Revenue\r\n\r\nSo far, the response to Elon Musk’s erratic leadership has been discouraging. Advertisers have left the platform in droves, fearing poor content moderation especially after Musk’s firing spree reduced the moderation team from hundreds to just 15.\r\n\r\nGeneral Motors (GM), General Mills Inc., (GIS), and Mondelez International (MDLZ) have all stopped posting Twitter ads. Many civic groups and advertising agencies have been urging brands to boycott the platform and warned Musk that they would pull ads if he continues to undermine Twitter’s community standards.\r\n\r\nThese concerns are warranted, it seems. According to researchers, racist slurs have been on the rise on the platform. After Ye’s antisemitic debacle, his supporters flooded the platform with racist tweets in his support, forcing Twitter to delete some of Ye’s tweets and suspend his account.\r\n\r\nTwitter is hemorrhaging revenue as scandals like this drive away advertisers. That’s why Musk is desperate to retain and grow revenue by charging users for verification and for consuming certain types of content, even as he pushes with his plans to overhaul the platform. \r\n“Thermonuclear” Campaign\r\n\r\nDespite his seemingly carefree campaigns at Twitter, Musk has been working on overdrive to prevent the mass exodus of advertisers from the platform. He already sent a message claiming that he wouldn’t let hate speech run free on the platform.\r\n\r\nIn the message, Musk said that Twitter cannot become a “free-for-all hellscape.” Even then, many brands such as Lucky Charms and Cheerios (under GIS), GM, Audi, and Pfizer are yet to be convinced.\r\n\r\nOn Friday, Musk supported a proposal to start a “thermonuclear name and shame campaign,” saying that he’d tried everything to “appease advertisers,” but activists have been working against him. \r\n\r\nHaving spent $44 billion on Twitter, we can understand why he’s so eager to keep up the revenue by any means possible.\r\nWhat Does it all Mean for Online Publishing?\r\n\r\nAmid all this chaos, and given how much power and influence Twitter (and Musk) wield, it’s unsettling to watch how it’s unfolding. Plenty of people have already weighed in on these events.\r\n\r\nAlexandra Ocasio-Cortez wasn’t impressed that a billionaire is selling free speech for $8 a month. Dinesh D’Souza and other conservatives are “giddy, hopeful, and incredulous,” and they celebrated by popping a $4,000 bottle of Louis XIII cognac.\r\n\r\nNovelist Stephen King promised to be “gone like Enron” if Musk instituted the $8 charge, and many other influential people feel the same. Those who joined the exodus, voluntarily or otherwise, include Whoopi Goldberg, Amber Heard, Shonda Rhimes, Sara Bareilles, Gigi Hadid, Toni Braxton, Ken Olin, and Mick Foley.\r\n\r\nWhat’s next for Elon Musk and Twitter? Honestly, we can’t tell. Online publishing changes daily, but you can stay in-the-know with us.', 1, '2024-12-05', 'active', '2024-12-06 10:51:49', '2024-12-06 10:38:29'),
(3, 'Sporting Camps &amp; Why Kids Need Them', 'sporting-camps-amp-why-kids-need-them', 'Screenshot 2024-12-06 at 4.09.00 PM.png', 'Every parent wants the best for their children, including love, happiness and…lots of money.\r\n\r\nWhen you hear how many millions of dollars top athletes such as LeBron James and Phil Mickelson make every year, it’s hard not to hope your own son or daughter might also excel in a sport at that level, especially if they’ve already demonstrated a love of and a talent for one game or another.\r\n\r\nEven if your child has never exhibited a propensity for athletics, maybe you just wish to gently nudge him or her outside, away from the TV screen, the video game console, or the smart phone.\r\n\r\nThis is a positive desire. According to the Center for Disease Control, in the past 30 years the rate of childhood obesity has doubled and the rate of adolescent obesity has quadrupled. In 2012, more than one-third of both children and adolescents were obese.\r\n\r\nAlso according to the CDC, exercise has many beneficial effects on health. Every year, many adults take up running, CrossFit, yoga and other programs to get in shape. Many of them wish to lose weight or alleviate a health problem. Wouldn’t it be even better if they had started exercising as children and never stopped?\r\n\r\nIf you can encourage your children to get physically active and keep at it their entire life, you’ve done them an enormous service, one that’s even more valuable than millions of dollars.\r\n\r\nSports camps are a great place to send kids while they’re off from school on summer vacation. They can learn to associate playing sports and exercise with fun, excitement and social interactions with teammates. Additionally, they can learn the technical skills that enable them to play better when returning to their home teams.\r\n\r\nAcross organizations like Little League, swim team workouts, and school athletics, the coaching quality can also vary a lot. (So does how much time the coach can dedicate to working with each player.) At a good sports camp, the counselors must know and love the skills they teach. Chances are good they still play their game or just left it. They’re not a traditional gym teacher who coaches everything from football to soccer to a full gymnasium of squirmy kids.\r\nWhich Kids Camp Is Best For Your Child?\r\n\r\nThat depends on a lot of factors. If your child is still around seven or younger, send him or her to one of the multi-sport camps for the youngest children. These camps concentrate on letting the kids have a good time, while at the same time developing their basic hand-eye coordination, sense of balance and ability, and willingness to just move.\r\n\r\nKids are introduced to different sports so they can decide and pursue what games or activities they enjoy the most.\r\nMulti-Sport Camps\r\n\r\nThese are great for older kids who want to have fun without committing (yet) to stardom in one particular sport. They get experience with many games and learn to play as a team member. They discover how important physical fitness is to all athletic achievement.\r\nSingle Sport Camps\r\n\r\nThese are where you can send your budding basketball or gymnastics star. Malcolm Gladwell popularized the notion that greatness at a skill takes 10,000 hours of practice. This certainly applies to athletes, who need to devote lots of time to physical conditioning as well as to the sport’s techniques.\r\n\r\nHowever, putting in the required work is difficult under ordinary circumstances. Kids spend at least nine months out of the year attending school classes. During the summer, other activities occupy their time. During their sport’s season they get regular workouts, but they’re not long, frequent, or hard enough to achieve greatness. Their coach may lack in-depth knowledge of that sport’s techniques. And when football season is over, it’s on to basketball.\r\n\r\nAt a single sport camp, kids can devote their time to that sport in a concentrated way that’s nearly impossible during their ordinary daily conditions. Instructors may know the latest strategies and tactics being used in the professional leagues.\r\n\r\nDo remember: Michael Jordan was nearly scrubbed from his high school basketball team. Not every future star looks like a winner when they’re just starting out.\r\n\r\nThe bleachers are full of Little League dads and soccer moms screaming for their children, but, eventually, the kids have to want it even more than mom and dad want it for them, or they won’t put in the extra effort when it’s required.\r\n\r\nYour child may or may not become a wealthy international sports star, but if they just win an athletic scholarship to college, that’s worth it, right?\r\n\r\nThough, if a sporting kids camp can give them a passion for physical health that keeps them moving and healthy, that’s worth more than all the blue ribbons, gold medals and trophies put together.', 2, '2024-12-06', 'active', '2024-12-06 10:51:54', '2024-12-06 10:39:28'),
(4, 'The Benefits Of Switching To Cloth Diapers', 'the-benefits-of-switching-to-cloth-diapers', 'Screenshot 2024-12-06 at 4.09.55 PM.png', 'In their first year of life, most babies will go through an average of 2,500-3,000 diapers. Depending on the brand you purchase, that can work out to an average of around $550 for the first year alone. Most babies don’t potty train after a year, either—and some are still in diapers well past their third birthdays!\r\n\r\nFor parents hoping to save a substantial amount of money on diapering their baby, cloth diapers are the obvious choice.\r\nThe Cost of Cloth\r\n\r\nA quick glance at the cost of cloth diapers may leave many parents reeling from sticker shock. $20 for a single diaper? Many turn straight back to disposables.\r\n\r\nHowever, a quick look at the numbers might convince you otherwise.\r\n\r\n    An average stash of cloth diapers is about 30 diapers. At $20 a diaper, you’ll break even just after baby’s first birthday.\r\n    There are cheaper options available! Expensive all-in-one diapers might run $20 a diaper, but prefolds and covers can be purchased for as little as $12-$15 each for the covers and around $3 each for the prefolds. With 5-8 covers and 30 inserts, you’ll pay less than $200 for a full stash of diapers.\r\n    Cloth diapers can be reused for multiple babies, so if you’re planning to expand your family down the road, your savings multiplies along with it.\r\n    Cloth diapers will never require a last-minute trip to the most expensive store in town because you’ve run out of diapers. You won’t have to throw away half a box of diapers because baby has outgrown them, either.\r\n    Cloth diapers have amazing resale value. Depending on the brand and the market, you can sell them for half or more of what you paid for them new.\r\n\r\nThe Benefits of Cloth Diapers\r\n\r\nSaving a little money isn’t the only benefit of cloth diapers. While many parents will admit that they fall in love with the fun array of prints and bright colors, there are plenty of hidden benefits to cloth diapers that many parents don’t realize at first.\r\n\r\n    Your baby will be exposed to fewer chemicals than you’ll find in disposable diapers. These chemicals can cause an increase in the potential for asthma, allergies, and other serious health concerns.\r\n    You’ll lessen your environmental impact: even with the need to wash cloth diapers, disposable diapers use 37% more water.\r\n    Your baby will have fewer diaper rashes, which means a happier, more pleasant baby.\r\n    Many cloth diapered babies potty train at an earlier age than their disposable-diapered peers.\r\n    Cloth diapers are less likely to leak than disposable diapers. Many parents report that they have far fewer blowouts with cloth.\r\n\r\nFor a world with an ever-growing awareness of humanity’s impact on the natural world, the sustainability of cloth diapers nearly outweighs the fact that you’re kissing diaper rash goodbye. You and your newborn get to feel good when you make the switch to cloth diapers over disposable alternatives.\r\nIs the Inconvenience Worth It?\r\n\r\nDiving in to cloth diapering baby products often seems daunting. There are diapers to wash, dry, and stuff. There are family members who will need to be taught how to use cloth diapers. Your diaper bag will have to be a lot bigger to hold those huge, fluffy diapers. Is it really worth the potential inconvenience? For many families, cloth diapers are actually more convenient than disposables.\r\n\r\nConsider this: you’ll never again have that terrifying moment when you reach into a diaper package and realize that you’ve pulled out the last one. You won’t have to go shopping when all you really want to do is stay at home, whether it’s because of a sick/cranky baby or a tired mommy. If a friend runs out of diapers while visiting with you, you’ll always have one on hand that’s just the right size.\r\n\r\nThere’s no feeling of panic when you’re at the end of your paycheck and not sure you have the extra money for diapers, either. You can choose to buy new diapers because you want to have more on hand or because you fall in love with a new color or print, but you don’t have to have them. That means you can save your money for more important things when finances are a little tight.\r\n\r\nSure, you have to throw in an extra load of laundry every few days, but since you’ll have fewer clothing changes for both you and baby because a disposable diaper failed to hold, you’ll quickly make up the difference. Not only that, you’ll discover that once you get into a routine, diaper laundry is one of the easiest loads of laundry you do in a week.\r\n\r\nFor many families, making the switch to cloth diapers is the obvious decision. It’s environmentally friendly and financially practical. Consider making the switch to cloth diapers for your family today.', 2, '2024-12-06', 'active', '2024-12-06 10:51:59', '2024-12-06 10:40:15');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(21) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mobile_no` varchar(255) DEFAULT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user',
  `status` enum('active','inactive') NOT NULL,
  `reset_token` varchar(255) DEFAULT NULL,
  `reset_token_expires` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `mobile_no`, `role`, `status`, `reset_token`, `reset_token_expires`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$Tm1e7NNqpY8ZFjw.gozQKO.ScsFE0sdKGbqwSr82uS7xcNR1PGYmC', '1234567890', 'admin', 'active', 'b32adecd82c02d645ebb904ac9a472186514b5e54f9c427a704d8456e6a2cdcb', '2024-12-06 16:44:01', '2024-12-06 07:14:55', '2024-12-06 10:14:01'),
(2, 'caleveva', 'sbasant12345@gmail.com', '$2y$10$sGYkFIS9giz7.OOCkz91buryOGMJ0A8NOSnXzrFiqX1GSMy5s.kBq', '1234567890', 'user', 'inactive', 'ec0df102b79cdf5076390073603f40908b0567c0db5dad4a3d2e3b8eab755212', '2024-12-06 16:45:18', '2024-12-06 07:11:42', '2024-12-06 10:31:06'),
(4, 'nynegonyq', 'bife@mailinator.com', '$2y$10$KIvukLucIqNt5bqSNZdV/.ulY3pIl2h9NYjUrKcfpMQwn6U.Ao2Iu', '1212312312', 'user', 'active', NULL, NULL, '2024-12-06 07:07:38', '2024-12-06 07:07:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(21) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(21) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(21) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(21) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
