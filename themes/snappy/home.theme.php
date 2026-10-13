<?php

declare(strict_types=1);

namespace Shimmie2;

use function MicroHTML\{A, H1, IMG, SMALL, SPAN, joinHTML};
use function MicroHTML\{BODY, DIV, INPUT, META, TITLE, emptyHTML, LINK};

use MicroHTML\HTMLElement;

class SnappyHomeTheme extends HomeTheme
{
    public function display_page(string $sitename, HTMLElement $body): void
    {
        Ctx::$page->add_auto_html_headers();
        Ctx::$page->set_data(MimeType::HTML, (string)Ctx::$page->html_html(
            emptyHTML(
                TITLE($sitename),
                META(["http-equiv" => "Content-Type", "content" => "text/html;charset=utf-8"]),
                META(["name" => "viewport", "content" => "width=device-width, initial-scale=1"]),
                LINK(["rel"=>"stylesheet","href"=>"https://cdn.snapps.dev/style/fonts.css"]),
                ...Ctx::$page->get_all_html_headers(),
            ),
            $body
        ));
    }

    public function build_body(
        string $sitename,
        HTMLElement $main_links,
        ?string $main_text,
        ?string $contact_link,
        int $post_count,
    ): HTMLElement {
        $page = Ctx::$page;
        $page->set_layout("front-page");

        return BODY(
            $page->body_attrs(),
            DIV(
                ["id" => "front-page"],
                $this->build_title($sitename),
                $this->build_links($main_links),
                $this->build_search(),
                $this->build_message($main_text),
                $this->build_counter($post_count),
                $this->build_footer($contact_link, $post_count),
            ),
        );
    }

    protected function build_title(string $sitename): HTMLElement
    {
        return H1(["data-label"=>$sitename],A(["href" => make_link()], SPAN($sitename)));
    }
}