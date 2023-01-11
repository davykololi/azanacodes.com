<?php

namespace App\Enums;

enum UserRoleEnum :  string{
	case Admin = 'admin';
	case Author = 'author';
	case Editor = 'editor';
	case Visitor = 'visitor';
}