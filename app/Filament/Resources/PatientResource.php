<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PatientResource\Pages;
use App\Models\Patient;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PatientResource extends Resource
{
    protected static ?string $model = Patient::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //Composant pour le formulaire
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                Select::make('type')
                    ->options([
                    'cat' => 'Cat',
                    'dog' => 'Dog',
                    'rabbit' => 'Rabbit',
                    ])->required(),

                DatePicker::make('date_of_birth')
                    ->required()
                    ->maxDate(now()),

                Select::make('owner_id')
                    ->relationship('owner', 'name')
                    ->searchable()
                    ->preload()
                    ->createOptionForm([
                        TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                        TextInput::make('email')
                        ->label('Email Adress')
                        ->email()
                        ->maxLength(255)
                        ->required(),
                        TextInput::make('phone')
                        ->label('Phone Number')
                        ->tel()
                        ->required()
                    ])
                    ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        //Column pour remplir le tableau qui affiche les infos
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('type'),
                Tables\Columns\TextColumn::make('date_of_birth')->sortable(),
                Tables\Columns\TextColumn::make('owner.name')->searchable(),
                Tables\Columns\TextColumn::make('owner.email'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                ->options([
                    'amet' => 'amet',
                    'facere' => 'facere',
                    'corrupti' => 'corrupti',
                ])
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //Enregistrement du nouveau gestionnaire de relations

            PatientResource\RelationManagers\TreatmentsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPatients::route('/'),
            'create' => Pages\CreatePatient::route('/create'),
            'edit' => Pages\EditPatient::route('/{record}/edit'),
        ];
    }
}
