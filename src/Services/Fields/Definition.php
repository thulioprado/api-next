<?php

declare(strict_types=1);

namespace Directus\Services\Fields;

use Illuminate\Support\Fluent;
use Illuminate\Support\Traits\Macroable;

// TODO: extract interface methods do macros through directus "plugins"

/**
 * @method Definition action(string $action)               Sets the field action
 * @method Definition id(string $id)                       Sets the unique id for the field
 * @method Definition name(string $name)                   Sets the name of the field
 * @method Definition on(string $collection)               Sets the target collection name
 * @method Definition collection(string $collection)       Sets the collection of the field
 * @method Definition collection_id(string $collection_id) Sets the collection_id of the field
 * @method Definition type(string $type)                   Sets the type of the field
 * @method Definition interface(string $interface)         Sets the interface of the field
 * @method Definition options(array|string $options)       Sets the field interface options
 * @method Definition locked()                             Sets the field as locked
 * @method Definition validation(string $validation)       Sets the field validation
 * @method Definition required()                           Sets the field as required
 * @method Definition hidden_detail()                      Sets the field as hidden_detail
 * @method Definition hidden_browse()                      Sets the field as hidden_browse
 * @method Definition index(int $index)                    Sets the field sort index
 * @method Definition width(string $width)                 Sets the field width
 * @method Definition note(string $note)                   Sets the field note
 * @method Definition readonly()                           Sets the field as readonly
 */
class Definition extends Fluent
{
    // Allows field definition extensions
    use Macroable {
        Macroable::__call as invokeMacro;
    }

    /**
     * Constructor.
     */
    public function __construct(string $id)
    {
        parent::__construct();
        $this->id($id);
    }

    /**
     * Calls macro or fluent interface.
     *
     * @param string $method
     * @param array  $parameters
     *
     * @return $this
     */
    public function __call($method, $parameters)
    {
        if (static::hasMacro($method)) {
            return $this->invokeMacro($method, $parameters);
        }

        return parent::__call($method, $parameters);
    }

    /**
     * Sets a property in the field definition.
     *
     * @param mixed $value
     */
    public function set(string $key, $value): self
    {
        $this->attributes[$key] = $value;

        return $this;
    }

    /**
     * Sets the field translation properties.
     */
    public function translate(array $options): self
    {
        $this->attributes['translation'] = $options;

        return $this;
    }

    /**
     * Set field to alias type.
     */
    public function alias(): self
    {
        return $this->type('alias');
    }

    /**
     * Set field to array type.
     */
    public function array(): self
    {
        return $this->type('array');
    }

    /**
     * Set field to boolean type.
     */
    public function boolean(): self
    {
        return $this->type('boolean');
    }

    /**
     * Set field to binary type.
     */
    public function binary(): self
    {
        return $this->type('binary');
    }

    /**
     * Set field to datetime type.
     */
    public function datetime(): self
    {
        return $this->type('datetime');
    }

    /**
     * Set field to date type.
     */
    public function date(): self
    {
        return $this->type('date');
    }

    /**
     * Set field to time type.
     */
    public function time(): self
    {
        return $this->type('time');
    }

    /**
     * Set field to file type.
     */
    public function file(): self
    {
        return $this->type('file');
    }

    /**
     * Set field to hash type.
     */
    public function hash(): self
    {
        return $this->type('hash');
    }

    /**
     * Set field to group type.
     */
    public function group(): self
    {
        return $this->type('group');
    }

    /**
     * Set field to integer type.
     */
    public function integer(): self
    {
        return $this->type('integer');
    }

    /**
     * Set field to decimal type.
     */
    public function decimal(): self
    {
        return $this->type('decimal');
    }

    /**
     * Set field to json type.
     */
    public function json(): self
    {
        return $this->type('json');
    }

    /**
     * Set field to translations type.
     */
    public function lang(): self
    {
        return $this->type('translations');
    }

    /**
     * Set field to m2o type.
     */
    public function m2o(): self
    {
        return $this->type('m2o');
    }

    /**
     * Set field to o2m type.
     */
    public function o2m(): self
    {
        return $this->type('o2m');
    }

    /**
     * Set field to slug type.
     */
    public function slug(): self
    {
        return $this->type('slug');
    }

    /**
     * Set field to sort type.
     */
    public function sort(): self
    {
        return $this->type('sort');
    }

    /**
     * Set field to status type.
     */
    public function status(): self
    {
        return $this->type('status');
    }

    /**
     * Set field to string type.
     */
    public function string(): self
    {
        return $this->type('string');
    }

    /**
     * Set field to translation type.
     */
    public function translation(): self
    {
        return $this->type('translation');
    }

    /**
     * Set field to uuid type.
     */
    public function uuid(): self
    {
        return $this->type('uuid');
    }

    /**
     * Set field to datetime_created type.
     */
    public function datetimeCreated(): self
    {
        return $this->type('datetime_created');
    }

    /**
     * Set field to datetime_updated type.
     */
    public function datetimeUpdated(): self
    {
        return $this->type('datetime_updated');
    }

    /**
     * Set field to owner type.
     */
    public function owner(): self
    {
        return $this->type('owner');
    }

    /**
     * Set field to user_updated type.
     */
    public function userUpdated(): self
    {
        return $this->type('user_updated');
    }

    /**
     * Set field to user type.
     */
    public function user(): self
    {
        return $this->type('user');
    }

    /// COMPLEMENTARY

    public function unlocked(): self
    {
        $this->attributes['locked'] = false;

        return $this;
    }

    /// INTERFACES

    /**
     * Creates a 2fa-secret field.
     */
    public function twoFactorSecretInterface(array $options = []): self
    {
        return $this->interface('2fa-secret')->options($options);
    }

    /**
     * Creates a button-group field.
     */
    public function buttonGroupInterface(array $options = []): self
    {
        return $this->interface('button-group')->options($options);
    }

    /**
     * Creates a calendar field.
     */
    public function calendarInterface(array $options = []): self
    {
        return $this->interface('calendar')->options($options);
    }

    /**
     * Creates a checkboxes-relational field.
     */
    public function checkboxesRelationalInterface(array $options = []): self
    {
        return $this->interface('checkboxes-relational')->options($options);
    }

    /**
     * Creates a checkboxes field.
     */
    public function checkboxesInterface(array $options = []): self
    {
        return $this->interface('checkboxes')->options($options);
    }

    /**
     * Creates a code field.
     */
    public function codeInterface(array $options = []): self
    {
        return $this->interface('code')->options($options);
    }

    /**
     * Creates a collections field.
     */
    public function collectionsInterface(array $options = []): self
    {
        return $this->interface('collections')->options($options);
    }

    /**
     * Creates a fields field.
     */
    public function fieldsInterface(array $options = []): self
    {
        return $this->interface('fields')->options($options);
    }

    /**
     * Creates a color-palette field.
     */
    public function colorPaletteInterface(array $options = []): self
    {
        return $this->interface('color-palette')->options($options);
    }

    /**
     * Creates a color field.
     */
    public function colorInterface(array $options = []): self
    {
        return $this->interface('color')->options($options);
    }

    /**
     * Creates a date field.
     */
    public function dateInterface(array $options = []): self
    {
        return $this->interface('date')->options($options);
    }

    /**
     * Creates a datetime-created field.
     */
    public function datetimeCreatedInterface(array $options = []): self
    {
        return $this->interface('datetime-created')->options($options);
    }

    /**
     * Creates a datetime-updated field.
     */
    public function datetimeUpdatedInterface(array $options = []): self
    {
        return $this->interface('datetime-updated')->options($options);
    }

    /**
     * Creates a datetime field.
     */
    public function datetimeInterface(array $options = []): self
    {
        return $this->interface('datetime')->options($options);
    }

    /**
     * Creates a divider field.
     */
    public function dividerInterface(array $options = []): self
    {
        return $this->interface('divider')->options($options);
    }

    /**
     * Creates a dropdown field.
     */
    public function dropdownInterface(array $options = []): self
    {
        return $this->interface('dropdown')->options($options);
    }

    /**
     * Creates a file-preview field.
     */
    public function filePreviewInterface(array $options = []): self
    {
        return $this->interface('file-preview')->options($options);
    }

    /**
     * Creates a file-size field.
     */
    public function fileSizeInterface(array $options = []): self
    {
        return $this->interface('file-size')->options($options);
    }

    /**
     * Creates a file field.
     */
    public function fileInterface(array $options = []): self
    {
        return $this->interface('file')->options($options);
    }

    /**
     * Creates a files field.
     */
    public function filesInterface(array $options = []): self
    {
        return $this->interface('files')->options($options);
    }

    /**
     * Creates a hashed field.
     */
    public function hashedInterface(array $options = []): self
    {
        return $this->interface('hashed')->options($options);
    }

    /**
     * Creates a icon field.
     */
    public function iconInterface(array $options = []): self
    {
        return $this->interface('icon')->options($options);
    }

    /**
     * Creates a interface-options field.
     */
    public function interfaceOptionsInterface(array $options = []): self
    {
        return $this->interface('interface-options')->options($options);
    }

    /**
     * Creates a interface-types field.
     */
    public function interfaceTypesInterface(array $options = []): self
    {
        return $this->interface('interface-types')->options($options);
    }

    /**
     * Creates a interfaces field.
     */
    public function interfacesInterface(array $options = []): self
    {
        return $this->interface('interfaces')->options($options);
    }

    /**
     * Creates a json field.
     */
    public function jsonInterface(array $options = []): self
    {
        return $this->interface('json')->options($options);
    }

    /**
     * Creates a key-value field.
     */
    public function keyValueInterface(array $options = []): self
    {
        return $this->interface('key-value')->options($options);
    }

    /**
     * Creates a language field.
     */
    public function languageInterface(array $options = []): self
    {
        return $this->interface('language')->options($options);
    }

    /**
     * Creates a many-to-many field.
     */
    public function manyToManyInterface(array $options = []): self
    {
        return $this->interface('many-to-many')->options($options);
    }

    /**
     * Creates a many-to-one field.
     */
    public function manyToOneInterface(array $options = []): self
    {
        return $this->interface('many-to-one')->options($options);
    }

    /**
     * Creates a map field.
     */
    public function mapInterface(array $options = []): self
    {
        return $this->interface('map')->options($options);
    }

    /**
     * Creates a markdown field.
     */
    public function markdownInterface(array $options = []): self
    {
        return $this->interface('markdown')->options($options);
    }

    /**
     * Creates a multiselect field.
     */
    public function multiselectInterface(array $options = []): self
    {
        return $this->interface('multiselect')->options($options);
    }

    /**
     * Creates a numeric field.
     */
    public function numericInterface(array $options = []): self
    {
        return $this->interface('numeric')->options($options);
    }

    /**
     * Creates a one-to-many field.
     */
    public function oneToManyInterface(array $options = []): self
    {
        return $this->interface('one-to-many')->options($options);
    }

    /**
     * Creates a owner field.
     */
    public function ownerInterface(array $options = []): self
    {
        return $this->interface('owner')->options($options);
    }

    /**
     * Creates a password field.
     */
    public function passwordInterface(array $options = []): self
    {
        return $this->interface('password')->options($options);
    }

    /**
     * Creates a preview field.
     */
    public function previewInterface(array $options = []): self
    {
        return $this->interface('preview')->options($options);
    }

    /**
     * Creates a primary-key field.
     */
    public function primaryKeyInterface(array $options = []): self
    {
        return $this->interface('primary-key')->options($options);
    }

    /**
     * Creates a radio-buttons field.
     */
    public function radioButtonsInterface(array $options = []): self
    {
        return $this->interface('radio-buttons')->options($options);
    }

    /**
     * Creates a rating field.
     */
    public function ratingInterface(array $options = []): self
    {
        return $this->interface('rating')->options($options);
    }

    /**
     * Creates a repeater field.
     */
    public function repeaterInterface(array $options = []): self
    {
        return $this->interface('repeater')->options($options);
    }

    /**
     * Creates a slider field.
     */
    public function sliderInterface(array $options = []): self
    {
        return $this->interface('slider')->options($options);
    }

    /**
     * Creates a slug field.
     */
    public function slugInterface(array $options = []): self
    {
        return $this->interface('slug')->options($options);
    }

    /**
     * Creates a sort field.
     */
    public function sortInterface(array $options = []): self
    {
        return $this->interface('sort')->options($options);
    }

    /**
     * Creates a status field.
     */
    public function statusInterface(array $options = []): self
    {
        return $this->interface('status')->options($options);
    }

    /**
     * Creates a switch field.
     */
    public function switchInterface(array $options = []): self
    {
        return $this->interface('switch')->options($options);
    }

    /**
     * Creates a tags field.
     */
    public function tagsInterface(array $options = []): self
    {
        return $this->interface('tags')->options($options);
    }

    /**
     * Creates a text-input field.
     */
    public function textInputInterface(array $options = []): self
    {
        return $this->interface('text-input')->options($options);
    }

    /**
     * Creates a textarea field.
     */
    public function textareaInterface(array $options = []): self
    {
        return $this->interface('textarea')->options($options);
    }

    /**
     * Creates a time field.
     */
    public function timeInterface(array $options = []): self
    {
        return $this->interface('time')->options($options);
    }

    /**
     * Creates a toggle-icon field.
     */
    public function toggleIconInterface(array $options = []): self
    {
        return $this->interface('toggle-icon')->options($options);
    }

    /**
     * Creates a translation field.
     */
    public function translationInterface(array $options = []): self
    {
        return $this->interface('translation')->options($options);
    }

    /**
     * Creates a user-roles field.
     */
    public function userRolesInterface(array $options = []): self
    {
        return $this->interface('user-roles')->options($options);
    }

    /**
     * Creates a user-updated field.
     */
    public function userUpdatedInterface(array $options = []): self
    {
        return $this->interface('user-updated')->options($options);
    }

    /**
     * Creates a user field.
     */
    public function userInterface(array $options = []): self
    {
        return $this->interface('user')->options($options);
    }

    /**
     * Creates a wysiwyg field.
     */
    public function wysiwygInterface(array $options = []): self
    {
        return $this->interface('wysiwyg')->options($options);
    }
}
