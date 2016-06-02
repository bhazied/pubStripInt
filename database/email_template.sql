INSERT INTO `email_template` (`id`, `name`, `slug`, `from_email`, `reply_to_email`, `subject`, `body`, `status`, `created_at`, `creator_user_id`, `modified_at`, `modifier_user_id`) VALUES
(2, 'first press release', 'pr_email', 'sahbi.khalfallah@continuousnet.com', 'zied.benhadjamor@continuousnet.com', 'the first press release to send', '<style type="text/css">\r\n  .header {\r\n    background: #8a8a8a;\r\n  }\r\n  .header .columns {\r\n    padding-bottom: 0;\r\n  }\r\n  .header p {\r\n    color: #fff;\r\n    padding-top: 15px;\r\n  }\r\n  .header .wrapper-inner {\r\n    padding: 20px;\r\n  }\r\n  .header .container {\r\n    background: transparent;\r\n  }\r\n  table.button.facebook table td {\r\n    background: #3B5998 !important;\r\n    border-color: #3B5998;\r\n  }\r\n  table.button.twitter table td {\r\n    background: #1daced !important;\r\n    border-color: #1daced;\r\n  }\r\n  table.button.google table td {\r\n    background: #DB4A39 !important;\r\n    border-color: #DB4A39;\r\n  }\r\n  .wrapper.secondary {\r\n    background: #f3f3f3;\r\n  }\r\n</style>\r\n\r\n<wrapper class="header">\r\n  <container>\r\n    <row class="collapse">\r\n      <columns small="6">\r\n        <!--<img src="http://placehold.it/200x50/663399">-->\r\n      </columns>\r\n      <columns small="6">\r\n        <p class="text-right">%title%</p>\r\n      </columns>\r\n    </row>\r\n  </container>\r\n</wrapper>\r\n\r\n<container>\r\n\r\n  <spacer size="16"></spacer>\r\n\r\n  <row>\r\n    <columns small="12">\r\n      <h1>%title%</h1>\r\n      <p class="lead">%description%</p>\r\n      <img src="% picture_preview%" alt="">\r\n      <callout class="primary">\r\n        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veniam assumenda, praesentium qui vitae voluptate dolores. <a href="#">Click it!</a></p>\r\n      </callout>\r\n      <h2>%title% <small></small></h2>\r\n      <p>%content%</p>\r\n      \r\n      <button class="large secondary" href="%pr_link%">Click Me!</button>\r\n\r\n    </columns>\r\n  </row>\r\n  \r\n  <wrapper class="secondary">\r\n\r\n    <spacer size="16"></spacer>\r\n\r\n    <row>\r\n      <columns large="6">\r\n        <h5>Connect With Us:</h5>\r\n        <button class="facebook expand" href="%facebook_link%">Facebook</button>\r\n        <button class="twitter expand" href="%twitter_link%">Twitter</button>\r\n        <button class="google expand" href="google_plus_link">Google+</button>\r\n      </columns>\r\n      <columns large="6">\r\n        <h5>Contact Info:</h5>\r\n        <p>Phone: 408-341-0600</p>\r\n        <p>Email: <a href="mailto:%mailto%">%mailto%</a></p>\r\n      </columns>\r\n    </row>\r\n  </wrapper>\r\n      \r\n  <center>\r\n    %footer%\r\n    <!--<menu>\r\n      <item href="#">Terms</item>\r\n      <item href="#">Privacy</item>\r\n      <item href="#">Unsubscribe</item>\r\n    </menu>-->\r\n  </center>\r\n\r\n</container>', 'Online', '2016-05-13 00:00:00', 11, NULL, NULL);