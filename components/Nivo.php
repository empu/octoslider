<?php namespace OctoDevel\OctoSlider\Components;

use \DB;
use Validator;
use Cms\Classes\ComponentBase;
use October\Rain\Support\ValidationException;
use OctoDevel\OctoSlider\Models\Item as SliderItem;

class Nivo extends ComponentBase
{
    public $nivoItems;
    public $jqueryIncludeNivo;
    public $effectNivo;
    public $slicesNivo;
    public $boxColsNivo;
    public $boxRowsNivo;
    public $animSpeedNivo;
    public $pauseTimeNivo;
    public $startSlideNivo;
    public $directionNavNivo;
    public $controlNavNivo;
    public $controlNavThumbsNivo;
    public $pauseOnHoverNivo;
    public $manualAdvanceNivo;
    public $prevTextNivo;
    public $nextTextNivo;
    public $randomStartNivo;
    public $themeNivo;

    public function componentDetails()
    {
        return [
            'name'        => 'Nivo jQuery Plugin',
            'description' => 'Display a slideshow from a selected octoslider item using Nivo Slider jQuery Plugin by Dev7Studios.'
        ];
    }

    public function defineProperties()
    {
        return [
            'idSlide' => [
                'title'        => 'Slider',
                'description'  => 'Choose the slider item that will display.',
                'type'         => 'dropdown',
                'default'      => '',
                'showExternalParameter' => false,
            ],
            'jqueryIncludeNivo' => [
                'title'        => 'Include jQuery',
                'description'  => 'If enabled the plugin will include jQuery library v1.9 in your theme. Requirement: jQuery library 1.7 or higher.',
                'type'         => 'dropdown',
                'default'      => 'no',
                'showExternalParameter' => false,
            ],
            'effectNivo' => [
                'title'        => 'Effects',
                'description'  => 'Specify the effect for your slides.',
                'type'         => 'dropdown',
                'default'      => 'random',
                'group'        => 'Effects',
                'showExternalParameter' => false,
            ],
            'slicesNivo' => [
                'title'        => 'Slices',
                'description'  => 'For slice animations.',
                'type'         => 'string',
                'validationPattern' => '^[1-9]+$',
                'validationMessage' => 'Invalid format.',
                'default'      => '15',
                'group'        => 'Effects',
                'showExternalParameter' => false,
            ],
            'boxColsNivo' => [
                'title'       => 'Box Cols',
                'description' => 'For box animations.',
                'type'        => 'string',
                'validationPattern' => '^[1-9]+$',
                'validationMessage' => 'Invalid format.',
                'default'     => '8',
                'group'       => 'Effects',
                'showExternalParameter' => false,
            ],
            'boxRowsNivo' => [
                'title'       => 'Box Rows',
                'description' => 'For box animations.',
                'type'        => 'string',
                'validationPattern' => '^[1-9]+$',
                'validationMessage' => 'Invalid format.',
                'default'     => '4',
                'group'       => 'Effects',
                'showExternalParameter' => false,
            ],
            'animSpeedNivo' => [
                'title'       => 'Animation Speed',
                'description' => 'Slide transition speed',
                'type'        => 'string',
                'validationPattern' => '^[0-9]+$',
                'validationMessage' => 'Invalid format.',
                'default'     => '500',
                'group'       => 'Effects',
                'showExternalParameter' => false,
            ],
            'pauseTimeNivo' => [
                'title'       => 'Pause Time',
                'description' => 'How long each slide will show',
                'type'        => 'string',
                'validationPattern' => '^[0-9]+$',
                'validationMessage' => 'Invalid format.',
                'default'     => '3000',
                'group'       => 'Options',
                'showExternalParameter' => false,
            ],
            'startSlideNivo' => [
                'title'       => 'Start Slide',
                'description' => 'Set starting Slide (0 index).',
                'type'        => 'string',
                'validationPattern' => '^[0-9]+$',
                'validationMessage' => 'Invalid format.',
                'default'     => '0',
                'group'       => 'Options',
                'showExternalParameter' => false,
            ],
            'directionNavNivo' => [
                'title'       => 'Direction Navigation',
                'description' => 'Display Next & Prev navigation',
                'type'        => 'dropdown',
                'default'     => 'true',
                'group'       => 'Options',
                'showExternalParameter' => false,
            ],
            'controlNavNivo' => [
                'title'       => 'Control Navigation',
                'description' => 'Display 1,2,3... navigation.',
                'type'        => 'dropdown',
                'default'     => 'true',
                'group'       => 'Options',
                'showExternalParameter' => false,
            ],
            'controlNavThumbsNivo' => [
                'title'       => 'Control Navigation Thumbs',
                'description' => 'Use thumbnails for Control Navigation.',
                'type'        => 'dropdown',
                'default'     => 'false',
                'group'       => 'Options',
                'showExternalParameter' => false,
            ],
            'pauseOnHoverNivo' => [
                'title'       => 'Pause on Hover',
                'description' => 'Pause on state hover. Not available for mobile devices.',
                'type'        => 'dropdown',
                'default'     => 'true',
                'group'       => 'Options',
                'showExternalParameter' => false,
            ],
            'manualAdvanceNivo' => [
                'title'       => 'Manual Advance',
                'description' => 'Force manual transitions.',
                'type'        => 'dropdown',
                'default'     => 'false',
                'group'       => 'Options',
                'showExternalParameter' => false,
            ],
            'randomStartNivo' => [
                'title'       => 'Random Start',
                'description' => 'Start on a random slide.',
                'type'        => 'dropdown',
                'default'     => 'false',
                'group'       => 'Options',
                'showExternalParameter' => false,
            ],
            'themeNivo' => [
                'title'       => 'Theme',
                'description' => 'Set a theme for your Nivo Slider or set as none to use your own.',
                'type'        => 'dropdown',
                'default'     => 'default',
                'group'       => 'Options',
                'showExternalParameter' => false,
            ],
            'prevTextNivo' => [
                'title'       => 'Prev Text',
                'description' => 'Prev direction navigation text.',
                'type'        => 'string',
                'default'     => 'Prev',
                'group'       => 'Translations',
                'showExternalParameter' => false,
            ],
            'nextTextNivo' => [
                'title'       => 'Next Text',
                'description' => 'Next direction navigation text.',
                'type'        => 'string',
                'default'     => 'Next',
                'group'       => 'Translations',
                'showExternalParameter' => false,
            ],

        ];
    }

    public function getIdSlideOptions()
    {
        $slides = SliderItem::all();

        $array_dropdown = ['0'=>'- select one - '];

        foreach ($slides as $slide)
        {
            $array_dropdown[$slide->id] = $slide->title;
        }

        return $array_dropdown;
    }

    public function getJqueryIncludeNivoOptions()
    {
        return ['no' => 'No', 'yes' => 'Yes'];
    }

    public function getEffectNivoOptions()
    {
        return [
            'random'    => 'Random',
            'sliceDown'     => 'Slice Down',
            'sliceDownLeft'       => 'Slice Down Left',
            'sliceUp'     => 'Slice Up',
            'sliceUpLeft'     => 'Slice up Left',
            'sliceUpDown'     => 'Slice up Down',
            'sliceUpDownLeft'      => 'Slice up Down Left',
            'fold'     => 'Fold',
            'fade'  => 'Fade',
            'slideInRight' => 'Slide in Right',
            'slideInLeft'    => 'Slide in Left',
            'boxRandom'      => 'Box Random',
            'boxRain'   => 'Box Rain',
            'boxRainReverse'      => 'Box Rain Reverse',
            'boxRainGrow'     => 'Box Rain Grow',
            'boxRainGrowReverse'      => 'Box Rain Grow Reverse'
        ];
    }

    public function getDirectionNavNivoOptions()
    {
        return ['false' => 'No', 'true' => 'Yes'];
    }

    public function getControlNavNivoOptions()
    {
        return ['false' => 'No', 'true' => 'Yes'];
    }

    public function getControlNavThumbsNivoOptions()
    {
        return ['false' => 'No', 'true' => 'Yes'];
    }

    public function getPauseOnHoverNivoOptions()
    {
        return ['false' => 'No', 'true' => 'Yes'];
    }

    public function getManualAdvanceNivoOptions()
    {
        return ['false' => 'No', 'true' => 'Yes'];
    }

    public function getRandomStartNivoOptions()
    {
        return ['false' => 'No', 'true' => 'Yes'];
    }

    public function getThemeNivoOptions()
    {
        return ['none' => '- none -', 'default' => 'Default', 'bar' => 'Bar', 'dark' => 'Dark', 'light' => 'Light'];
    }

    public function onRun()
    {
        // Getting register
        $sliderItem = new SliderItem();
        $item = $sliderItem->where('id', '=', $this->property('idSlide'))->first();
        $this->nivoItems = $this->page['nivoItems'] = $item;

        // Setting parameters
        $this->jqueryIncludeNivo = $this->page['jqueryIncludeNivo'] = $this->property('jqueryIncludeNivo');
        $this->effectNivo = $this->page['effectNivo'] = $this->property('effectNivo');
        $this->slicesNivo = $this->page['slicesNivo'] = $this->property('slicesNivo');
        $this->boxColsNivo = $this->page['boxColsNivo'] = $this->property('boxColsNivo');
        $this->boxRowsNivo = $this->page['boxRowsNivo'] = $this->property('boxRowsNivo');
        $this->animSpeedNivo = $this->page['animSpeedNivo'] = $this->property('animSpeedNivo');
        $this->pauseTimeNivo = $this->page['pauseTimeNivo'] = $this->property('pauseTimeNivo');
        $this->startSlideNivo = $this->page['startSlideNivo'] = $this->property('startSlideNivo');
        $this->directionNavNivo = $this->page['directionNavNivo'] = $this->property('directionNavNivo');
        $this->controlNavNivo = $this->page['controlNavNivo'] = $this->property('controlNavNivo');
        $this->controlNavThumbsNivo = $this->page['controlNavThumbsNivo'] = $this->property('controlNavThumbsNivo');
        $this->pauseOnHoverNivo = $this->page['pauseOnHoverNivo'] = $this->property('pauseOnHoverNivo');
        $this->manualAdvanceNivo = $this->page['manualAdvanceNivo'] = $this->property('manualAdvanceNivo');
        $this->prevTextNivo = $this->page['prevTextNivo'] = $this->property('prevTextNivo');
        $this->nextTextNivo = $this->page['nextTextNivo'] = $this->property('nextTextNivo');
        $this->randomStartNivo = $this->page['randomStartNivo'] = $this->property('randomStartNivo');
        $this->themeNivo = $this->page['themeNivo'] = $this->property('themeNivo');

        // Add vendors
        $this->addCss('assets/vendor/dev7studios/nivo-slider/css/nivo-slider.css');

        // Add theme
        if($this->themeNivo != 'none')
            $this->addCss('assets/vendor/dev7studios/nivo-slider/css/themes/'. $this->themeNivo .'/'. $this->themeNivo .'.css');

        // Include jQuery
        if($this->jqueryIncludeNivo == 'yes')
            $this->addJs('assets/js/jquery-1.9.0.min.js');

        $this->addJs('assets/vendor/dev7studios/nivo-slider/scripts/jquery.nivo.slider.pack.js');
    }
}