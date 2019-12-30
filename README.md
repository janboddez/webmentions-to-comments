# Webmention Comments
Basic Webmention support for WordPress.

Turns incoming webmentions into comments. All webmentions undergo basic validation and are then dumped into a database table. The content of that table is processed once per hour, i.e., asynchronously. No more than 5 webmentions are dealt with at once, in order to minimally burden the server WordPress is running on.

## Microformats
Source URLs of which the markup contains so-called [microformats](http://microformats.org/)—those generated by Bridgy, most blog posts—undergo some additional, rudimentary parsing.

## Outgoing Webmentions
Since version 0.5, whenever a post is first published, this plugin will attempt to notify URLs mentioned in the post's body, using the [Webmention Client](https://github.com/indieweb/mention-client-php) for PHP.

This behavior, however, is easily disabled by adding `define('OUTGOING_WEBMENTIONS', false);` to your `wp-config.php` (and may soon move to a standalone plugin).

To re-send a webmention when a published post is updated, one would have to first delete the (hidden) `_webmention_sent` custom field for that post. It is entirely possible to do so, but requires some creativity. (I.e., for power users only.)

Sending webmentions on delete is not currently supported.

## Filter and Action Hooks
### `webmention_comments_post_types`
Use to declare supported post types. Example:
```
add_filter( 'webmention_comments_post_types', function( $post_types ) {
  // These post types support (both receiving and sending) webmentions.
  return array( 'post', 'page', 'jetpack-portfolio' );
} );
```

### `webmention_comments_post`
Use to override the "post fetching algorithm." Example:
```
add_filter( 'webmention_comments_post', $post, $request['target'], $supported_post_types ) {
  if ( empty( $post ) ) {
    // Could we be looking for a page rather than a post?
    trim( wp_parse_url( $request['target'], PHP_URL_PATH ), '/' );
    $post = get_page_by_path( $path );
  }

  return $post;
}, 10, 3 );
```

### `webmention_comments_sender_ip`
Use to override the "client IP address." Example:
```
add_filter( 'webmention_comments_sender_ip', function( $ip, $request ) {
  if ( ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
      $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
  }

  return $ip;
}, 10, 2 );
```

### `webmention_comments_comment`
Use to override comment content. Example:
```
add_filter( 'webmention_comments_comment', function( $comment_content, $hentry, $source, $target ) {
  if ( ! empty( $hentry['properties']['bookmark-of'] ) &&
       is_array( $hentry['properties']['bookmark-of'] ) &&
       in_array( $target, $hentry['properties']['bookmark-of'], true ) ) {
    $comment_content = __( '&hellip; decided to bookmark this post! Whoo!' );
  }

  return $comment_content;
}, 10, 4 );
```
