<?php  namespace Gen\Syntax;

trait Word {

    protected $words = [
        's'  => 'string',
        't'  => 'timestamp',
        'e'  => 'enum',
        'i'  => 'integer',
        'd'  => 'date',
        'pu' => 'publish',
        'up' => 'unpublish',
        'tr' => 'trash',
        'ti' => 'title',
        'na' => 'name',
        'st' => 'status',
        'us' => 'username',
        'pb' => 'published_at',
        'nu' => 'nullable',
        'un' => 'unsigned',
        'lorem' =>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Cras elementum ultrices diam. Maecenas ligula massa, varius a, semper congue, euismod non, mi. Proin porttitor, orci nec nonummy molestie, enim est eleifend mi, non fermentum diam nisl sit amet erat. Duis semper. Duis arcu massa, scelerisque vitae, consequat in, pretium a, enim. Pellentesque congue. Ut in risus volutpat libero pharetra tempor. Cras vestibulum bibendum augue. Praesent egestas leo in pede. Praesent blandit odio eu enim. Pellentesque sed dui ut augue blandit sodales. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aliquam nibh. Mauris ac mauris sed pede pellentesque fermentum. Maecenas adipiscing ante non diam sodales hendrerit.'

    ];

    /**
     * @param $word
     * @return string
     */
    public function longWord($word)
    {
        return (isset($this->words[$word])) ? $this->words[$word] : $word;
    }

}