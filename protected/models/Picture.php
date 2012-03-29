<?php

/**
 * This is the model class for table "picture".
 *
 * The followings are the available columns in table 'picture':
 * @property integer $id
 * @property string $name
 * @property string $path
 * @property integer $size
 * @property string $type
 * @property string $extension
 * @property string $created_at
 * @property string $title
 * @property string $description
 * @property string $location
 * @property string $date
 * @property integer $related_id
 * @property string $related
 *
 * @property Group[] $groups
 * @property GroupPicture[] $groupPictures
 */
class Picture extends ActiveRecord
{
    const DEFAULT_ID = 1;

    public $storePath;
    
    public $instance;

    /**
     * Returns the static model of the specified AR class.
     * @return Picture the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'picture';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('instance', 'file', 'allowEmpty' => true, 'types' => 'jpg, gif, png', 'maxSize' => 1024 * 1024 * 2, 'tooLarge' => t('Dozvoljena veličina slike je 2MB.')),
            array('size, related_id', 'numerical', 'integerOnly'=>true),
            array('name, related', 'length', 'max'=>32),
            array('path', 'length','max'=>1000),
            array('type, title, location', 'length', 'max'=>64),
            array('extension', 'length', 'max'=>8),
            array('created_at', 'length', 'max'=>10),
            array('description', 'length', 'max'=>128),
            array('date', 'safe'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'groups' => array(self::HAS_MANY, 'Group', 'profile_picture_id'),
            'groupPictures' => array(self::HAS_MANY, 'GroupPicture', 'picture_id'),            
        );
    }

    /**
     * @return array customized attribute labels (name => label)
     */
    public function attributeLabels()
    {
        return array(
            'title' => t('Naslov'),
            'description' => t('Opis'),
            'location' => t('Lokacija'),
            'date' => t('Datum'),
            'instance' => t('Slika'),
        );
    }

    protected function beforeSave()
    {
        if ($this->isNewRecord)
        {
            $this->created_at = time();
        }
        return parent::beforeSave();
    }

    public function prepare()
    {
        $this->path = Utility::generateHash();
        
        $levelOne = substr($this->path, 0, 2);
        $levelTwo = substr($this->path, 2, 2);
        $levelThree = substr($this->path, 4, 2);

        $this->name = substr($this->path, 6);
        $this->path = "$levelOne/$levelTwo/$levelThree/{$this->name}";//.{$this->extension}";

        $this->storePath = path('webroot.images') . "/$levelOne/$levelTwo/$levelThree";
        @mkdir($this->storePath, 0777, true);

        return $this;
    }

    public static function getDefault()
    {
        return self::model()->findByPk(self::DEFAULT_ID);
    }

    public function getRealPath($suffix = '')
    {
        return path('webroot.images') . "/{$this->path}$suffix.{$this->extension}";
    }

    public function generateThumbs()
    {
        $imageProcessor = new ImageProcessor($this->realPath);
        $imageProcessor->resize(351, 226);
        $imageProcessor->save($this->storePath . '/' . $this->name . '_front.' . $this->extension);
        $imageProcessor = new ImageProcessor($this->realPath);
        $imageProcessor->resize(140, 104);
        $imageProcessor->save($this->storePath . '/' . $this->name . '_small.' . $this->extension);
        $imageProcessor = new ImageProcessor($this->realPath);
        $imageProcessor->resize(526, 393);
        $imageProcessor->save($this->storePath . '/' . $this->name . '_large.' . $this->extension);
        $imageProcessor = new ImageProcessor($this->realPath);
        $imageProcessor->resize(351, 262); // profile size
        $imageProcessor->save($this->realPath); // without suffix
    }

    public function getShortPath($suffix = '', $absolute = false)
    {
        return bu($absolute) . "/images/{$this->path}$suffix.{$this->extension}";
    }
    
    public static function belongsToGroup($id)
    {
        return Group::belongsToGroup($id);
    }
    
    public static function belongsToArtist($id)
    {
        return Artist::belongsToArtist($id);
    }
    
    public function remove()
    {
        $level = explode('/', $this->path);
        $root = path('webroot.images');
        
        $dir = "$root/$level[0]/$level[1]/$level[2]";
        
        @unlink("$dir/{$this->name}.{$this->extension}");
        @unlink("$dir/{$this->name}_front.{$this->extension}");
        @unlink("$dir/{$this->name}_small.{$this->extension}");
        @unlink("$dir/{$this->name}_large.{$this->extension}");
        
        if (count(@scandir($dir)) == 2)
        {
            @rmdir("$root/$level[0]/$level[1]/$level[2]");
            @rmdir("$root/$level[0]/$level[1]");
            @rmdir("$root/$level[0]");
        }
        
        return $this->delete();
    }
    
    public function getFancybox()
    {
        return nl2br(e(trim(e($this->title) . "\n" . e($this->location) . "\n" . e($this->description))));
    }

}