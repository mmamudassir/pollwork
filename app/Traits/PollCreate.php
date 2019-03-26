<?php

namespace App\Traits;

use App\Option;
use Illuminate\Support\Facades\DB;

trait PollCreate {
    protected $options_add = [];

    /**
     * Add an option to the array if not exists
     *
     * @param $option
     * @return bool
     */
    private function pushOption($option)
    {
        if(! in_array($option, $this->options_add)){
            $this->options_add[] = $option;
            return true;
        }
        return false;
    }

    /**
     * Add new Options
     *
     * @param $options
     * @return $this
     * @throws \InvalidArgumentException
     */
    public function addOptions($options)
    {
        if(is_array($options))
        {
            foreach($options as $option){
                if(is_string($option) ){
                    $this->pushOption($option);
                }
            }
            return $this;
        }

        if(is_string($options)){
            $this->pushOption($options);
            return $this;
        }

        throw new \InvalidArgumentException("Invalid Argument provided");
    }

    /**
     * Generate the poll
     *
     */
    public function generate()
    {
        $totalOptions = count($this->options_add);

        // No option add yet
        if($totalOptions == 0)
            \InvalidArgumentException("No poll option provided");

        // There must be 2 options at least
        if($totalOptions == 1 )
            \InvalidArgumentException("Each poll must have at least two poll options ");

        // Create Poll && assign options to it
        DB::transaction(function () {
            $this->save();
            $this->options()
                ->saveMany($this->instantiateOptions());
        });

        return true;
    }

    /**
     * Instantiate the options
     *
     * @return array
     */
    private function instantiateOptions()
    {
        $options = [];
        foreach($this->options_add as $option){
            $options[] = new Option([
                'name' => $option
            ]);
        }

        return $options;
    }
}