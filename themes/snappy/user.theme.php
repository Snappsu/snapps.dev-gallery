<?php

declare(strict_types=1);

namespace Shimmie2;

use function MicroHTML\{A, BR, INPUT, LABEL, OPTION, P, SELECT, SMALL, TABLE, TBODY, TD, TFOOT, TH, TR, emptyHTML, joinHTML};

use MicroHTML\HTMLElement;

class SnappyUserPageTheme extends UserPageTheme
{
    public function display_login_block(): void
    {
        ;
    }

    public function display_login_page(): void
    {
        Ctx::$page->set_title("Login");
        Ctx::$page->set_layout("no-left");
        $html = SHM_SIMPLE_FORM(
            make_link("user_admin/login"),
            TABLE(
                ["summary" => "Login Form"],
                TR(
                    TD(["width" => "70"], LABEL(["for" => "user"], "Name")),
                    TD(["width" => "70"], INPUT(["type" => "text", "name" => "user", "id" => "user"]))
                ),
                TR(
                    TD(LABEL(["for" => "pass"], "Password")),
                    TD(INPUT(["type" => "password", "name" => "pass", "id" => "pass"]))
                ),
                TR(
                    TD(["colspan" => "2"], SHM_SUBMIT("Log In"))
                )
            )
        );
        if (Ctx::$config->get(UserAccountsConfig::SIGNUP_ENABLED)) {
            $html->appendChild(SMALL(A(["href" => make_link("user_admin/create")], "Create Account")));
        }
        Ctx::$page->add_block(new Block("Login", $html, "main", 90));
    }
}

