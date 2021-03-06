<?php # -*- coding: utf-8 -*-

namespace TheDramatistBoilerplate;
$base_dir = dirname( __DIR__ );

/*
 * Folder layout.
 */
$folders = [
	'config'    => "{$base_dir}/_config",
	'scripts'   => "{$base_dir}/_scripts",
	'templates' => "{$base_dir}/_templates",
	'vendor'    => "{$base_dir}/vendor",
	'vcs'       => "{$base_dir}/.git",
];

/*
 * Placeholder definitions.
 */
$placeholders = [
	'vendor' => [
		'name'        => 'Vendor name',
		'description' => "Human readable vendor name (probably your company's name)",
		'validation'  => function ( $placeholder ) {

			return Validation::validateTrimmed( $placeholder );
		},
		'default'     => 'TheDramatist',
	],
	'vendor_key' => [
		'name'        => 'Vendor name in lowercase',
		'description' => 'Used in composer package name (no spaces, [a-z0-9-] )',
		'validation'  => function ( $placeholder ) {

			return Validation::validateLowerCase( $placeholder );
		},
		'default'     => function ( $placeholders ) {

			return SetupHelper::getLowerCase( $placeholders[ 'vendor' ][ 'value' ] );
		},
	],
	'package' => [
		'name'        => 'Package name',
		'description' => 'Human readable package name',
		'validation'  => function ( $placeholder ) {

			return Validation::validateTrimmed( $placeholder );
		},
		'default'     => 'Awesome WordPress Plugin',
	],
	'package_key' => [
		'name'        => 'Package name in lowercase',
		'description' => 'Used for the composer package name (no spaces, [a-z0-9-] )',
		'validation'  => function ( $placeholder ) {

			return Validation::validateLowerCase( $placeholder );
		},
		'default'     => function ( $placeholders ) {

			return SetupHelper::getLowerCase( $placeholders[ 'package' ][ 'value' ] );
		},
	],
	'license' => [
		'name'        => 'License',
		'description' => 'License abbreviation [MIT|GPL]',
		'validation'  => function ( $placeholder ) {

			return SetupHelper::getSPDXLicense(
				Validation::validateLicenseAbbr( $placeholder )
			);
		},
		'default'     => 'GPL',
	],
	'type' => [
		'name'        => 'Package type',
		'description' => 'The composer type of the package (library, wordpress-plugin, wordpress-theme or project)',
		'validation'  =>  function ( $placeholder ) {

			return Validation::validatePackageType( $placeholder );
		},
		'default'     => 'wordpress-plugin'
	],
	'namespace'     => [
		'name'        => 'Package base namespace',
		'description' => 'The base PHP namespace of the package.',
		'validation'  => function ( $placeholder ) {

			return Validation::validatePascalCase( $placeholder );
		},
		'default'     => function ( $placeholders ) {

			return $placeholders['vendor']['value'] . '\\' . SetupHelper::getPascalCase( $placeholders[ 'package' ][ 'value' ] );
		},
	],
	/**
	 * Note: 'namespace_autoload' is set in task FormatAutoloadNamespace
	 */
	'textdomain'     => [
		'name'        => 'Textdomain',
		'description' => 'Used for translation in gettext functions',
		'validation'  => function ( $placeholder ) {

			return Validation::validateLowerCase( $placeholder );
		},
		'default'     => function ( $placeholders ) {

			return $placeholders[ 'package_key' ][ 'value' ];
		},
	],
	'description' => [
		'name'        => 'Package description',
		'description' => 'The package description in one sentence',
		'validation'  => function ( $placeholder ) {

			return Validation::validateTrimmed( $placeholder );
		},
		'default'     => 'TODO: Describe what this package is all about',
	],
	'author'      => [
		'name'        => 'Author name',
		'description' => 'The name of the author (in person) of the package',
		'validation'  => function ( $placeholder ) {

			return Validation::validateTrimmed( $placeholder );
		},
		'default'     => 'Khan M Rashedun-Naby',
	],
	'email'       => [
		'name'        => 'Author email',
		'description' => 'The email of the author.',
		'validation'  => function ( $placeholder ) {

			return Validation::validateEmail( $placeholder );
		},
		'default'     => 'naby88@gmail.com',
	]
	/**
	 * Note: the 'year' parameter is declared in Task\DeclareDate
	 */
];

return [
	'TheDramatist' => [
		'Boilerplate' => [
			'Folders'           => $folders,
			'Placeholders'      => $placeholders,
			'TemplateExtension' => '.template',
			'BaseDir'           => $base_dir
		],
	],
];
